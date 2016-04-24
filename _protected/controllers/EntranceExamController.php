<?php

namespace app\controllers;

use Yii;
use app\models\ApplicantForm;
use app\models\EntranceExamForm;
use app\models\EntranceExamFormSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\MethodNotAllowedHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Response;
use app\models\GradeLevel;
use yii\helpers\ArrayHelper;
use app\rbac\models\AuthAssignment;
use yii\widgets\Alert;
/**
 * EntranceExamController implements the CRUD actions for EntranceExamForm model.
 */
class EntranceExamController extends Controller
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
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index' , 'create', 'view', 'update','pjax', 'grade-level', 'card'],
                        'allow' => false,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['index' , 'create', 'view', 'update', 'delete', 'pjax', 'section', 'grade-level', 'card', 'permission'],
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
                    'gradeLevel' => ['post'],
                    'pjax' => ['post'],
                    'permission' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all EntranceExamForm models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EntranceExamFormSearch();
        $dataProvider = $searchModel->searchEntranceExam(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single EntranceExamForm model.
     * @param string $id
     * @return mixed
     */
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
     * Creates a new EntranceExamForm model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new EntranceExamForm();
        $model->english = 0;
        $model->reading_skills = 0;
        $model->science = 0;
        $model->comprehension = 0;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }


    public function actionCard($data){
        if(Yii::$app->request->isAjax && !Yii::$app->user->isGuest){
            Yii::$app->response->format = Response::FORMAT_JSON;
            
            $object = json_decode($data);
            
            $id = $object->sid;
            $applicant = $this->findApplicant($id);
            $sped = (int) $applicant->sped;
            $level = $applicant->gradeLevel->name;
            $bdate = $applicant->birth_date;
            $date = strtotime($bdate);
            $y = date('Y', $date);
            $m = date('m', $date);
            $d = date('d', $date);
            $age = \Carbon\Carbon::createFromDate($y, $m, $d)->age;
            $bday = \Carbon\Carbon::create($y, $m, $d)->toFormattedDateString();

            if(!empty($applicant->students_profile_image)){
                $img = Yii::$app->request->baseUrl . '/uploads/students/' . $applicant->students_profile_image;
            }else {
                $img = 'empty';
            }
            
            !empty(trim($applicant->middle_name)) ? $middle = ucfirst(substr($applicant->middle_name, 0,1)).'.' : $middle = '';

            $data = array(
                    'sid'=> $applicant->id, 
                    'act'=> (int) $applicant->status,
                    'name' =>  implode(' ', [$applicant->first_name, $middle, $applicant->last_name]),
                    'nick' => ucfirst('\'' . $applicant->nickname . '\''),
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
        $student = ApplicantForm::find()->where(['id' => $id])->all();
        
        foreach ($student as $item) {
            return $item->grade_level_id;
        }
    }
    /**
     * Updates an existing EntranceExamForm model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing EntranceExamForm model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if(AuthAssignment::getAssignment(Yii::$app->user->identity->id) === 'dev'){
            $flash = Yii::$app->session->setFlash('error', ['Error 1', 'Error 2']);
            
            return $this->redirect('view', ['id' => $id, 'flash' => $flash]);
        } else {
            //$this->findModel($id)->delete();
            return $this->redirect(['index']);
        }

    }

    public function actionPermission(){

        if(Yii::$app->request->isAjax && !Yii::$app->user->isGuest){
            Yii::$app->response->format = Response::FORMAT_JSON;
            
            $auth = false;

            $data = (object) array(
                    'id' => Yii::$app->user->identity->id,
                    'auth' => $auth
                );
            
            return $data;
        }

    }
    /**
     * Finds the EntranceExamForm model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return EntranceExamForm the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = EntranceExamForm::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findApplicant($id)
    {
        if (($applicant = ApplicantForm::findOne($id)) !== null) {
            return $applicant;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
