<?php

namespace app\controllers;

use Yii;
use app\models\LearningArea;
use app\models\Subject;
use app\models\Section;
use app\models\AssignedForm;
use app\models\AssignedFormSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AssignSubjectController implements the CRUD actions for AssignedForm model.
 */
class AssignSubjectController extends Controller
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
                    'lists' => ['post'],
                    'section' => ['post'],
                ],
            ],
        ];
    }

    public function actionSection($id)
    {
        $section = Section::find()->where(['grade_level_id' => $id])/*->orderBy(['section_name', SORT_ASC])*/->all();
        
        foreach ($section as $item) {
            echo '<option value="' . $item->id . '">' . $item->section_name . '</option>';
        }
    }

    public function actionLists($id)
    {
        $subjects = LearningArea::find()->where(['grade_level_id' => $id])->orderBy('sequence', SORT_ASC)->all();
        $count = count($subjects);
        if($subjects > 0){
            for($x = 0;  $x < $count; $x++){
                //$name = Subject::find()->where(['id' => $subject->id])->all();
                echo "<option value='". $subjects[$x]['subject_id'] . "'>"  . $subjects[$x]->subject->subject_name . "</option>";
            }
        }
        else{
            echo "<option></option>";
        }
    }

    /**
     * Lists all AssignedForm models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AssignedFormSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AssignedForm model.
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
     * Creates a new AssignedForm model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AssignedForm();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing AssignedForm model.
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
     * Deletes an existing AssignedForm model.
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
     * Finds the AssignedForm model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return AssignedForm the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AssignedForm::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
