<?php

namespace app\controllers;

use Yii;
use app\models\EnrolledForm;
use app\models\StudentForm;
use app\models\PaymentForm;
use app\models\Tuition;
use app\models\SiblingDiscount;
use app\models\AssessmentForm;
use app\models\AssessmentFormSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * AssessmentFormController implements the CRUD actions for AssessmentForm model.
 */
class AssessmentController extends Controller
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
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'pjax' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all AssessmentForm models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AssessmentFormSearch();
        $dataProvider = $searchModel->searchAssessment(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AssessmentForm model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
            'payments' => $this->findPayments($id),
        ]);
    }

    /**
     * Creates a new AssessmentForm model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate(){

        $model = new AssessmentForm();
        throw new NotFoundHttpException('The requested page does not exist.');
        
        /*if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }*/
    }

    public function actionNew($eid){
        $eid = (int) $eid;
        $id = EnrolledForm::findOne($eid);

        if($id !== null){
            $model = new AssessmentForm();
            $student_id = (int) $id->student_id;
            $grade_level_id = (int) $id->grade_level_id;
            $student = StudentForm::findOne($id->student_id);
            $tuition = Tuition::find()->where(['grade_level_id' => $grade_level_id])->orderBy(['id' => SORT_DESC])->all();
            $model->enrolled_id = $eid;
            $tid = (int) $tuition[0]['id'];
            $model->tuition_id = $tid;
            $model->has_sibling_discount = (int) $model->has_sibling_discount;
            $model->has_book_discount = (int) $model->has_book_discount;
            $model->has_honor_discount = (int) $model->has_honor_discount;

            if(!empty($tuition)){
                $array = $tuition;
            } else {
                throw new NotFoundHttpException('Oops, Something went wrong.');
            }

            //$tuition_detail = Tuition::find()->where(['grade_level_id' => $grade_level_id])->orderBy(['id' => SORT_DESC])->all();
            
            if ($model->load(Yii::$app->request->post()) && $model->save() ){

                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('new', [
                    'model' => $model,
                    'student' => $student,
                    'tid' => $tid,
                    'array' => $array,
                ]);
            }
        }else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Updates an existing AssessmentForm model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            Yii::$app->session->setFlash('success', 'Saved successfully');
            return $this->redirect(['view', 'id' => $model->id]);
        } else {

            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing AssessmentForm model.
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


    public function actionPjax($data){
        if(Yii::$app->request->isAjax && !Yii::$app->user->isGuest){
            Yii::$app->response->format = Response::FORMAT_JSON;
            
            $object = json_decode($data);
            $u = $this->findModel($object->uid);

            if($u->updated_at !== $object->upd){
                $data = array('pjax' => true, 'delta' => true, 'upd' => $u->updated_at);
            }else {
                $data = array('pjax' => false, 'delta' => false, 'upd' => $object->upd);
            }


            return $data;
        }
    }

    /**
     * Finds the AssessmentForm model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return AssessmentForm the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AssessmentForm::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findTuition($id)
    {
        if (($model = Tuition::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    protected function findPayments($id)
    {
        if ((($payments = PaymentForm::find()->where(['assessment_id' => $id])->orderBy(['id' => SORT_DESC])->all() ) !== null)) {
            return $payments;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
