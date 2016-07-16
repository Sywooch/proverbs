<?php

namespace app\controllers;

use Yii;
use app\models\GradeOneForm;
use app\rbac\models\AuthAssignment;
use app\models\EnrolledForm;
use app\models\GradeOneFormSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GradeOneController implements the CRUD actions for GradeOneForm model.
 */
class GradeOneController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all GradeOneForm models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GradeOneFormSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single GradeOneForm model.
     * @param string $id
     * @return mixed
     */
    public function actionView($eid, $grading)
    {
        return $this->render('view', [
            'model' => $this->findGrade($eid, $grading),
            'eid' => $eid,
            'grading' => $grading
        ]);
    }

    /**
     * Creates a new GradeOneForm model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($eid)
    {
        // if(AuthAssignment::getAssignment(Yii::$app->user->identity->id) === 'principal' ||
        //     AuthAssignment::getAssignment(Yii::$app->user->identity->id) === 'teacher' ||
        //     AuthAssignment::getAssignment(Yii::$app->user->identity->id) === 'staff' ||
        //     AuthAssignment::getAssignment(Yii::$app->user->identity->id) === 'cashier' ||
        //     AuthAssignment::getAssignment(Yii::$app->user->identity->id) === 'parent'
        // ){
        //     throw new NotFoundHttpException('The requested page does not exist.');
        // }

        if (($enrolled = EnrolledForm::findOne($eid)) !== null) {
            $model = new GradeOneForm();
            $exist = GradeOneForm::find()->where(['enrolled_id' => $eid])->exists();
            //CHECK IF RECORD EXIST
            //
            $model->grade_protection = 1;
            $model->enrolled_id = $eid;
            $model->grading_period = 1;

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                //CREATE FOUR GRADINGS
                for($i = 2; $i < 5; $i++){
                    $grade = new GradeOneForm();
                    $grade->grade_protection = 1;
                    $grade->enrolled_id = $eid;
                    $grade->grading_period = $i;
                    $grade->save();
                }
                //die(var_dump($_POST));

                Yii::$app->session->setFlash('success', 'New grade successfully created!');

                //return $this->redirect(['view', 'id' => $model->id]);
                return $this->redirect('index');
            } else {
                return $this->render('create', [
                    'model' => $model,
                    'enrolled' => $enrolled,
                    'exist' => $exist
                ]);
            }
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

    }

    /**
     * Updates an existing GradeOneForm model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($eid, $grading)
    {
        $model = $this->findGrade($eid, $grading);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            Yii::$app->session->setFlash('success', 'Saved successfully');
            return $this->redirect(['view', 'eid' => $eid, 'grading' => $grading]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'eid' => $eid,
                'grading' => $grading,
            ]);
        }
    }

    /**
     * Deletes an existing GradeOneForm model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        //$this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the GradeOneForm model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return GradeOneForm the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = GradeOneForm::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findGrade($eid, $grading)
    {
        if (($model = GradeOneForm::find()->where(['enrolled_id' => $eid])->andWhere(['grading_period' => $grading])->one() ) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
