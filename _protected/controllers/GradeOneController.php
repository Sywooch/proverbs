<?php

namespace app\controllers;

use Yii;
use app\models\GradeOneForm;
use app\rbac\models\AuthAssignment;
use app\models\EnrolledForm;
use app\models\GradeOneFormSearch;
use yii\web\Controller;
use \yii\base\Model;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;
use yii\imagine\Image;
use app\models\File;

/**
 * GradeOneController implements the CRUD actions for GradeOneForm model.
 */
class GradeOneController extends Controller
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
        $dataProvider = $searchModel->searchGradeOne(Yii::$app->request->queryParams);

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
    public function actionView($eid)
    {
        return $this->render('view', [
            'models' => $this->findGrade($eid),
            'eid' => $eid,
        ]);
    }

    /**
     * Creates a new GradeOneForm model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($eid)
    {
        throw new ForbiddenHttpException("Error Processing Request", 403, null);
    }

    /**
     * Updates an existing GradeOneForm model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($eid)
    {
        $models = $this::findGrade($eid);

        if (Model::loadMultiple($models, Yii::$app->request->post()) && Model::validateMultiple($models)) {
            $count = 0;
            foreach ($models as $model) {
               // populate and save records for each model
                if ($model->save()) {
                    // do something here after saving
                    $count++;
                }
            }
            Yii::$app->session->setFlash('success', 'Grade saved successfully!');
            return $this->render('view', [
                'models' => $models,
                'eid' => $eid
            ]);
        } else {
            return $this->render('update', [
                'models' => $models,
                'eid' => $eid
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

    protected function findGrade($eid)
    {
        if (($model = GradeOneForm::find()->where(['enrolled_id' => $eid])->all() ) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
