<?php

namespace app\controllers;

use Yii;
use app\models\StudentForm;
use app\models\StudentFormSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Response;
use yii\imagine\Image;
use app\models\File;

/**
 * StudentsController implements the CRUD actions for StudentForm model.
 */
class StudentsController extends Controller
{
/*
    public $jsFile;

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
                //'only' => ['index' , 'create', 'view', 'update'],
                'rules' => [
                    [
                        'actions' => ['index' , 'create', 'view', 'update'],
                        'allow' => false,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['index' , 'create', 'view', 'update', 'pjax'],
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
                    'pjax' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all StudentForm models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StudentFormSearch();
        $dataProvider = $searchModel->searchStudent(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single StudentForm model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new StudentForm model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new StudentForm();
        $gen_date = date('ymdHis');
        $py = (int) substr($gen_date, 0,2);
        $pm = (int) substr($gen_date, 2,2);
        $pd = (int) substr($gen_date, 4,2);
        $ph = (int) substr($gen_date, 6,2);
        $pi = (int) substr($gen_date, 8,2);
        $ps = (int) substr($gen_date, 10,2);
        $parsed = $py.$pm.$pd.$ph.$pi.$ps;
        $model->id = $parsed;
        $model->status = 1;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            Yii::$app->session->setFlash('success', 'New student successfully created!');
            return $this->redirect(['view', 'id' => $model->id]);
        } else {

            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing StudentForm model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $temp = $model->students_profile_image;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            Yii::$app->session->setFlash('success', 'Saved successfully');

            if($temp !== $model->students_profile_image){
                $this->generateThumbnail($model->students_profile_image);
            }

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function generateThumbnail($file)
    {
        //MAKE A THUMBNAIL COPY
        $image = File::findImage($file)->toArray()['filename'];
        if(file_exists($image)){
            $dir = explode('students\\', File::findImage($file)->toArray()['filename'])[1];
            $folder = explode('\\', $dir);
            $file_name = explode('.', $folder[1])[0];
            $extension = explode('.', $folder[1])[1];
            mkdir(Yii::getAlias('@webroot/uploads/thumbnails/' . $folder[0]) );
            Image::thumbnail($image, 64, 64)->save(Yii::getAlias('@webroot/uploads/thumbnails/' . $folder[0] . '/' . $file_name . '.' . $extension), ['quality' => 100]);
        }
    }

    /**
     * Deletes an existing StudentForm model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $student = $this->findModel($id);
        $student->status = 100;
        $student->save();

        Yii::$app->session->setFlash('success', 'Deleted successfully');
        return $this->redirect(['index']);
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
     * Finds the StudentForm model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return StudentForm the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = StudentForm::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
