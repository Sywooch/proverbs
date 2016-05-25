<?php

namespace app\controllers;

use Yii;
use app\models\SchoolYear;
use app\models\SchoolYearSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Response;
/**
 * SchoolYearController implements the CRUD actions for SchoolYear model.
 */
class SchoolYearController extends Controller
{
    /**
     * @inheritdoc
     */
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
                        'roles' => ['dev', 'master', 'admin'],
                    ],
                    [
                        'actions' => ['pjax'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                    'pjax' => ['POST'],
                ],
            ],
        ];
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
     * Lists all SchoolYear models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SchoolYearSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SchoolYear model.
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
     * Creates a new SchoolYear model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SchoolYear();

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
     * Updates an existing SchoolYear model.
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
     * Deletes an existing SchoolYear model.
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
     * Finds the SchoolYear model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return SchoolYear the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SchoolYear::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
