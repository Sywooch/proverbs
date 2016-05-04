<?php

namespace app\controllers;

use Yii;
use app\models\EnrolledForm;
use app\models\EnrolledFormSearch;
use app\models\AssessmentForm;
use app\models\Tuition;
use app\models\StudentForm;
use app\models\Section;
use app\models\SchoolYear;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Response;
use app\models\GradeLevel;
use yii\helpers\ArrayHelper;
/**
 * EnrollController implements the CRUD actions for EnrolledForm model.
 */
class EnrollController extends Controller
{
/*    public $jsFile;

    public function init() {
        parent::init();

        $this->jsFile = '@app/views/' . $this->id . '/ajax.js';
        Yii::$app->assetManager->publish($this->jsFile);
        $this->getView()->registerJsFile(
            Yii::$app->assetManager->getPublishedUrl($this->jsFile),
            ['yii\web\YiiAsset']
        );
    }*/

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index' , 'create', 'view', 'update','pjax', 'grade-level', 'card'],
                        'allow' => false,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['index' , 'create', 'view', 'update', 'pjax', 'section', 'grade-level', 'card'],
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
                    'card' => ['post'],
                    'section' => ['post'],
                    'findTuitionId' => ['post'],
                    'gradeLevel' => ['post'],
                    'pjax' => ['post'],
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
        $grade_level = GradeLevel::find()->all();
        $school_year = SchoolYear::find()->orderBy(['id' => SORT_DESC])->all();
        $listData = ArrayHelper::map($grade_level, 'id' , 'name');
        $listData2 = ArrayHelper::map($school_year, 'id' , 'sy');
        $searchModel = new EnrolledFormSearch();
        $searchModel->sy_id = $this->findLatestSy();
        $searchModel->enrollment_status = 1;
        $dataProvider = $searchModel->searchEnrolled(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'listData' => $listData,
            'listData2' => $listData2,
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

            Yii::$app->session->setFlash('success', 'New enrollee successfully created!');
            Yii::$app->session->setFlash('success', 'New assessment successfully created!');
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

    public function actionPjax($data){
        if(Yii::$app->request->isAjax && !Yii::$app->user->isGuest){
            Yii::$app->response->format = Response::FORMAT_JSON;
            
            $object = json_decode($data);
            $student = $this->findModel($object->uid);

            if($student->updated_at !== $object->upd){
                $data = array('pjax' => true, 'delta' => true, 'upd' => $student->updated_at);
            }else {
                $data = array('pjax' => false, 'delta' => false, 'upd' => $object->upd);
            }

            return $data;
        }
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
        $model->enrollment_status = 1;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            Yii::$app->session->setFlash('success', 'New enrollee successfully created!');
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'sy' => $sy,
            ]);
        }
    }

    public function actionCard($data){
        if(Yii::$app->request->isAjax && !Yii::$app->user->isGuest){
            Yii::$app->response->format = Response::FORMAT_JSON;
            
            $object = json_decode($data);
            
            $id = $object->sid;
            $student = $this->findStudent($id);
            $sped = (int) $student->sped;
            $level = $student->gradeLevel->name;
            $bdate = $student->birth_date;
            $date = strtotime($bdate);
            $y = date('Y', $date);
            $m = date('m', $date);
            $d = date('d', $date);
            $age = \Carbon\Carbon::createFromDate($y, $m, $d)->age;
            $bday = \Carbon\Carbon::create($y, $m, $d)->toFormattedDateString();

            if(!empty($student->students_profile_image)){
                $img = Yii::$app->request->baseUrl . '/uploads/students/' . $student->students_profile_image;
            }else {
                $img = 'empty';
            }
            
            !empty(trim($student->middle_name)) ? $middle = ucfirst(substr($student->middle_name, 0,1)).'.' : $middle = '';

            $data = array(
                    'sid'=> $student->id, 
                    'act'=> (int) $student->status,
                    'name' =>  implode(' ', [$student->first_name, $middle, $student->last_name]),
                    'nick' => ucfirst('\'' . $student->nickname . '\''),
                    'bday' => $bday,
                    'age' => $age,
                    'level' => $level,
                    'spd' => $sped,
                    'img' => $img,
                );

            return $data;
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
        if(!Yii::$app->user->isGuest){
            $section = Section::find()->where(['grade_level_id' => $id])/*->orderBy(['section_name', SORT_ASC])*/->all();

            foreach ($section as $item) {
                echo '<option value="' . $item->id . '">' . $item->section_name . '</option>';
            }
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
        $student = $this->findStudent($model->student_id);
        //$model->student_id = $student->id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            Yii::$app->session->setFlash('success', 'Saved successfully');
            return $this->redirect('index');
        } else {
            return $this->render('update', [
                'model' => $model,
                'student' => $student,
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
        
        Yii::$app->session->setFlash('success', 'Deleted successfully');
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

    public function checkAssessment($id)
    {
        if($this->findAssessment($id) !== null){

            return $this->findAssessment($id);
        } else {

            return null;
        }
    }

    protected function findAssessment($id)
    {
        $model = AssessmentForm::find()->where(['enrolled_id' => $id])->all();

        if (!empty($model)) {

            return $model;
        } else {

            return null;
        }
    }

    protected function findLatestSy()
    {   
        $school_year = SchoolYear::find()->orderBy(['id' => SORT_DESC])->all();

        return $school_year[0]->sy;
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
