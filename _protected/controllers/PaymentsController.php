<?php

namespace app\controllers;

use Yii;
use app\models\PaymentForm;
use app\models\PaymentFormSearch;
use app\models\StudentForm;
use app\models\EnrolledForm;
use app\models\AssessmentForm;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * PaymentsController implements the CRUD actions for Payment model.
 */
class PaymentsController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => false,
                        'roles' => ['?', 'parent'],
                    ],
                    [
                        'actions' => ['index','create', 'update', 'view'],
                        'allow' => true,
                        'roles' => ['cashier'],
                    ],
                    [
                        'allow' => true,
                        'roles' => ['dev', 'master', 'admin'],
                    ],
                    [
                        'actions' => ['new'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'fetch' => ['post'],
                    'push' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Payment models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PaymentFormSearch();
        $dataProvider = $searchModel->searchPayment(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Payment model.
     * @param string $id
     * @return mixed
     */

    public function actionNew($sid, $aid, $type = null)
    {
        $model = new PaymentForm();
        $student = $this->findStudent($sid);
        $assessment = $this->findAssessment($aid);
        $eid = $assessment->enrolled->student_id;

        if($type === null){
            $type = null;
        } elseif((int) $type === 1) {
            $type = (int) $type;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        if($sid === $eid){
            $model->student_id = $student->id;
            $model->assessment_id = $assessment->id;
            $model->paid_amount = number_format(0, 2, '.', '');

            if($type != null || !empty($type)){
                $model->payment_description = $type;
            }

            if ($model->load(Yii::$app->request->post()) && $model->save()) {

                $amount = (float) $model->paid_amount;
                $this->touchBalance($aid, $amount);

                if($model->payment_description === 1){
                    $eid = (int) $model->assessment->enrolled_id;
                    $this->touchEnrolleeStatus($eid);
                }

                Yii::$app->session->setFlash('success', 'New payment successfully created!');
                return $this->redirect('index');
            } else {
                return $this->render('new', [
                    'student' => $student,
                    'assessment' => $assessment,
                    'model' => $model,
                ]);
            }
        }else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Payment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PaymentForm();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            Yii::$app->session->setFlash('success', 'Saved successfully');
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
    /**
     * Updates an existing Payment model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            Yii::$app->session->setFlash('success', 'Saved successfully');
            return $this->redirect('index');
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Payment model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        Yii::$app->session->setFlash('success', 'Deleted successfully');
        return $this->redirect(['index']);
    }

    /**
     * Finds the Payment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Payment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PaymentForm::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findStudent($id)
    {
        if ((($student = StudentForm::findOne($id)) !== null)) {
            return $student;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findAssessment($id)
    {
        if ((($assessment = AssessmentForm::findOne($id)) !== null) ) {
            return $assessment;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function touchBalance($aid, $amount){

        $assessment = $this->findAssessment($aid);
        $new_balance = $assessment->balance - (float) $amount;

        if($new_balance < 0){
            $assessment->balance = 0;
        }else {
            $assessment->balance = $new_balance;
        }

        $assessment->save();
        Yii::$app->session->setFlash('success2', 'Assessment saved successfully');
    }

    protected function touchEnrolleeStatus($eid)
    {
        if ((($enrollee = EnrolledForm::findOne($eid)) !== null)) {
            $enrollee->enrollment_status = 0;
            $enrollee->save();
            Yii::$app->session->setFlash('success2', 'Assessment saved successfully');
        }
    }
}
