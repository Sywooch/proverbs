<?php

namespace app\controllers;

use Yii;
use app\models\EnrolledForm;
use app\models\EnrolledFormSearch;
use app\models\AssessmentForm;
use app\models\Tuition;
use app\models\Section;
use app\models\StudentForm;
use app\models\SchoolYear;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EnrollController implements the CRUD actions for EnrolledForm model.
 */
class EnrollController extends Controller
{
    public $jsFile;

    public function init() {
        parent::init();

        $this->jsFile = '@app/views/' . $this->id . '/ajax.js';
        Yii::$app->assetManager->publish($this->jsFile);
        $this->getView()->registerJsFile(
            Yii::$app->assetManager->getPublishedUrl($this->jsFile),
            ['yii\web\YiiAsset']
        );
    }

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'fetch' => ['post'],
                    'push' => ['post'],
                    'section' => ['post'],
                    'findTuitionId' => ['post'],
                    'gradeLevel' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all EnrolledForm models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EnrolledFormSearch();
        $dataProvider = $searchModel->searchEnrolled(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single EnrolledForm model.
     * @param string $id
     * @return mixed
     */
    public function actionNew($id)
    {
        $model = new EnrolledForm();
        $student = $this->findStudent($id);
        $model->student_id = $student->id;
        $model->enrollment_status = 0;
        $model->grade_level_id = $student->grade_level_id;
        $express = true;

    if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('new', [
                'student' => $student,
                'model' => $model,
                'express' => $express,
            ]);
        }
    }   

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new EnrolledForm model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $sy = new SchoolYear();
        $model = new EnrolledForm();
        $assessment = new AssessmentForm();
        $model->enrollment_status = 0;

        if ($model->load(Yii::$app->request->post()) && $model->save(false) /* && $assessment->load(Yii::$app->request->post()) && Model::validateMultiple([$model, $assessment]) */) {
            die('ye');
            $tuition = Tuition::find()->where(['grade_level_id' => $model->grade_level_id])->orderBy(['id' => SORT_DESC])->all();
            $tuition_id = $tuition[0]['id'];
            
            $assessment = new AssessmentForm();
            $assessment->enrolled_id = $model->id;
            $assessment->tuition_id = $tuition_id;
            $assessment->save();

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'assessment' => $assessment,
                'sy' => $sy,
            ]);
        }
    }

    public function actionGradeLevel($id)
    {
        $student = StudentForm::find()->where(['id' => $id])->all();
        
        foreach ($student as $item) {
            return $item->grade_level_id;
        }
    }

    public function actionSection($id)
    {
        $section = Section::find()->where(['grade_level_id' => $id])/*->orderBy(['section_name', SORT_ASC])*/->all();

        foreach ($section as $item) {
            echo '<option value="' . $item->id . '">' . $item->section_name . '</option>';
        }
    }
    /**
     * Updates an existing EnrolledForm model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //die('status: ' . $model->enrollment_status);
            return $this->redirect(['view', 'id' => $model->id]);
            return $this->redirect('index');
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing EnrolledForm model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {        
        $this->findModel($id)->delete();
        $this->deleteAssessment($id);

        return $this->redirect(['index']);
    }

    /**
     * Finds the EnrolledForm model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return EnrolledForm the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function deleteAssessment($id)
    {
        if (($assessment = AssessmentForm::find()->where(['enrolled_id' => $id])->all()) !== null) {
            \Yii::$app
                ->db
                ->createCommand()
                ->delete('assessment', ['enrolled_id' => $id])
                ->execute();
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findModel($id)
    {
        if (($model = EnrolledForm::findOne($id)) !== null) {
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
}
