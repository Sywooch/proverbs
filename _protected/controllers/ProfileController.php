<?php

namespace app\controllers;

use Yii;
use app\models\ProfileForm;
use app\models\ProfileFormSearch;
use yii\behaviors\TimeStampBehavior;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\imagine\Image;
use app\models\File;
/**
 * ProfileController implements the CRUD actions for ProfileForm model.
 */
class ProfileController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
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
     * Lists all ProfileForm models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProfileFormSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'model' => $this->findModel(Yii::$app->user->identity->id),
        ]);
    }

    /**
     * Displays a single ProfileForm model.
     * @param integer $id
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
     * Creates a new ProfileForm model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ProfileForm();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ProfileForm model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $temp = $model->profile_image;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            Yii::$app->session->setFlash('success', 'Saved successfully');
            
            if($temp !== $model->profile_image){
                $this->generateThumbnail($model->profile_image);
            }

            return $this->redirect('index');
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
            $dir = explode('users\\', File::findImage($file)->toArray()['filename'])[1];
            $folder = explode('\\', $dir);
            $file_name = explode('.', $folder[1])[0];
            $extension = explode('.', $folder[1])[1];
            mkdir(Yii::getAlias('@webroot/uploads/thumbnails/' . $folder[0]) );
            Image::thumbnail($image, 64, 64)->save(Yii::getAlias('@webroot/uploads/thumbnails/' . $folder[0] . '/' . $file_name . '.' . $extension), ['quality' => 100]);
        }
    }

    /**
     * Finds the ProfileForm model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProfileForm the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProfileForm::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
