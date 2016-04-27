<?php

namespace app\controllers;

use Yii;
use app\models\ClassAdviserForm;
use app\models\ClassAdviserFormSearch;
use yii\web\Controller;
use yii\web\Response;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\rbac\models\Role;
use app\models\User;
use app\models\Section;
/**
 * ClassAdviserController implements the CRUD actions for ClassAdviserForm model.
 */
class ClassAdviserController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index' , 'create', 'view', 'update', 'new'],
                'rules' => [
                    [
                        'actions' => ['index' , 'create', 'view', 'update', 'new'],
                        'allow' => false,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['index' , 'create', 'view', 'update', 'new', 'pjax'],
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
                    'section' => ['post'],
                    'pjax' => ['post'],
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

    public function actionSection($id)
    {
        $section = Section::find()->where(['grade_level_id' => $id])/*->orderBy(['section_name', SORT_ASC])*/->all();
        
        foreach ($section as $item) {
            echo '<option value="' . $item->id . '">' . $item->section_name . '</option>';
        }
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
                Yii::$app->session->setFlash('success', 'New Class Adviser successfully created!');
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
           
           Yii::$app->session->setFlash('success', 'Saved successfully');
           return $this->redirect(['view', 'id' => $model->id]);
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

        Yii::$app->session->setFlash('success', 'Deleted successfully');
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
