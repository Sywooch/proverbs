<?php

namespace app\controllers;

use Yii;
use app\models\LearningArea;
use app\models\LearningAreaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * LearningAreaController implements the CRUD actions for LearningArea model.
 */
class LearningAreaController extends Controller
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
                        'roles' => ['dev'],
                    ],
                    [
                        'actions' => ['index', 'view'],
                        'allow' => true,
                        'roles' => ['principal', 'teacher'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all LearningArea models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LearningAreaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single LearningArea model.
     * @param integer $id
     * @param integer $subject_id
     * @return mixed
     */
    public function actionView($id, $subject_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id, $subject_id),
        ]);
    }

    /**
     * Creates a new LearningArea model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new LearningArea();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'subject_id' => $model->subject_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing LearningArea model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @param integer $subject_id
     * @return mixed
     */
    public function actionUpdate($id, $subject_id)
    {
        $model = $this->findModel($id, $subject_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'subject_id' => $model->subject_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing LearningArea model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @param integer $subject_id
     * @return mixed
     */
    public function actionDelete($id, $subject_id)
    {
        $this->findModel($id, $subject_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the LearningArea model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @param integer $subject_id
     * @return LearningArea the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $subject_id)
    {
        if (($model = LearningArea::findOne(['id' => $id, 'subject_id' => $subject_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
