<?php

namespace app\controllers;

use Yii;
use app\models\ClassAdviserForm;
use app\models\ClassAdviserFormSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\rbac\models\Role;
use app\models\User;
/**
 * ClassAdviserController implements the CRUD actions for ClassAdviserForm model.
 */
class ClassAdviserController extends Controller
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
     * Lists all ClassAdviserForm models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ClassAdviserFormSearch();
        $searchModel->sy_id = date('Y');
        $queryParams = array_merge(array(),Yii::$app->request->getQueryParams());
        $dataProvider = $searchModel->searchClassAdviser(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ClassAdviserForm model.
     * @param integer $teacher_id
     * @param integer $grade_level_id
     * @param string $sy_id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ClassAdviserForm model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ClassAdviserForm();
        $teachers = User::find()->joinWith('role')->where(['item_name' => 'teacher']);

       if($model->load(Yii::$app->request->post())){
            //CHECK FOR DUPLICATE ALL SAME ATTRIBUTE VALUES
            if(ClassAdviserForm::find()->where([ 'teacher_id' => $model->teacher_id])->where([ 'grade_level_id' => $model->grade_level_id])->andWhere(['sy_id' => $model->sy_id])->exists()){
                //BACK TO FORM
                return $this->render('create', [
                    'model' => $model,
                    'teachers' => $teachers,
                ]);
            } else { //ALL THREE NO DUPLICATES
                $model->save();
                return $this->redirect('index');
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'teachers' => $teachers,
            ]);
        }
    }

    /**
     * Updates an existing ClassAdviserForm model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $teacher_id
     * @param integer $grade_level_id
     * @param string $sy_id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
           //return $this->redirect(['view', 'id' => $model->id]);
            return $this->redirect('index');
        } else {
           return $this->render('update', [
               'model' => $model,
           ]);
        }

    }

    /**
     * Deletes an existing ClassAdviserForm model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $teacher_id
     * @param integer $grade_level_id
     * @param string $sy_id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ClassAdviserForm model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $teacher_id
     * @param integer $grade_level_id
     * @param string $sy_id
     * @return ClassAdviserForm the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ClassAdviserForm::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
