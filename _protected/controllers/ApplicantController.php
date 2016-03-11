<?php

namespace app\controllers;

use Yii;
use app\models\ApplicantForm;
use app\models\ApplicantFormSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ApplicantController implements the CRUD actions for ApplicantForm model.
 */
class ApplicantController extends Controller
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
                ],
            ],
        ];
    }

    /**
     * Lists all ApplicantForm models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ApplicantFormSearch();
        $dataProvider = $searchModel->searchStatus(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ApplicantForm model.
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
     * Creates a new ApplicantForm model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ApplicantForm();
        $gen_date = date('ymdHis');
        $py = (int) substr($gen_date, 0,2);
        $pm = (int) substr($gen_date, 2,2);
        $pd = (int) substr($gen_date, 4,2);
        $ph = (int) substr($gen_date, 6,2);
        $pi = (int) substr($gen_date, 8,2);
        $ps = (int) substr($gen_date, 10,2);
        $parsed = $py.$pm.$pd.$ph.$pi.$ps;
        $model->id = $parsed;
        $model->status = 2;
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ApplicantForm model.
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
     * Deletes an existing ApplicantForm model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ApplicantForm model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ApplicantForm the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ApplicantForm::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
