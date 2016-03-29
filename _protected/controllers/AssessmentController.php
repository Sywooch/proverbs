<?php

namespace app\controllers;

use Yii;
use app\models\EnrolledForm;
use app\models\StudentForm;
use app\models\Tuition;
use app\models\SiblingDiscount;
use app\models\AssessmentForm;
use app\models\AssessmentFormSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * AssessmentFormController implements the CRUD actions for AssessmentForm model.
 */
class AssessmentController extends Controller
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
                'only' => ['index' , 'create', 'view', 'update', 'new'],
                'rules' => [
                    [
                        'actions' => ['index' , 'create', 'view', 'update', 'new'],
                        'allow' => false,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['index' , 'create', 'view', 'update', 'new'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'sbd' => ['post'],
                    'dlist' => ['post'],
                    'calc' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all AssessmentForm models.
     * @return mixed
     */
    public function actionIndex()
    {
        /*if (Yii::$app->user->isGuest) 
            return $this->redirect('site/login');*/

        $searchModel = new AssessmentFormSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AssessmentForm model.
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
     * Creates a new AssessmentForm model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AssessmentForm();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
    public function actionCalc($data){
        if(Yii::$app->request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            
            $object = json_decode($data);

            if((int) $object->sbi === 1){

                $object->dri = (int) $object->dri;
                $object->sbi = (int) $object->sbi;
                $object->bki = (int) $object->bki;
                $object->hri = (int) $object->hri;

                $object->sbv = (float) $object->sbv;
                $object->bkv = (float) $object->bkv;
                $object->hrv = (float) $object->hrv;
                $object->bkt = (float) $object->bkt;
                $object->bal = (float) $object->bal;

                $total       = (float) $object->ttl;
                $balance     = $total;
                $books       = (float) $object->bkt;
                $yearly      = (float) $object->yra;

                $discount    = $object->dri/100 * $object->tff + ($object->bki === 1 ? $object->bkv : 0)  + ($object->hri === 1 ? $object->hrv : 0);
                $total = $yearly + $books - $discount;
                
                $object->sub = number_format($yearly + $books, 2);
                $object->yra = number_format($yearly, 2);
                $object->bkt = number_format($books, 2);
                $object->sdt = $object->dri . " % x " . number_format($object->tff, 2) . ' = ' . number_format(($object->dri/100 * $object->tff), 2);
                $object->sbv = $object->dri/100 * $object->tff;
                $object->tdf = number_format($discount, 2);

                $object->ttl = $total;
                $object->bal = $total;

                return $object;
            } else {

                $object->dri = (int) $object->dri;
                $object->sbi = (int) $object->sbi;
                $object->bki = (int) $object->bki;
                $object->hri = (int) $object->hri;

                $object->sbv = (float) 0;
                $object->bkv = (float) $object->bkv;
                $object->hrv = (float) $object->hrv;
                $object->bkt = (float) $object->bkt;

                $total       = (float) $object->ttl;
                $books       = (float) $object->bkt;
                $yearly      = (float) $object->yra;

                $discount    = ($object->bki === 1 ? $object->bkv : 0)  + ($object->hri === 1 ? $object->hrv : 0);
                $total       = $yearly + $books - $discount;

                $object->sub = number_format($yearly + $books, 2);
                $object->yra = number_format($yearly, 2);
                $object->bkt = number_format($books, 2);
                $object->sdt = "0";
                $object->sbv = 0;

                $object->tdf = number_format($discount, 2);

                $object->ttl = $total;
                $object->bal = $total;

                return $object;
            }

            return $object;

        } else {
            throw new NotFoundHttpException('Oops, Something went wrong.');
        }
    }

    public function actionSbd($cd, $id, $t, $sb, $bd, $hd){
        $cd = (int) $cd;
        $id = (int) $id;
        
        if($cd === 0){
            $value = 1;
        } else {
            $value = 0;
            //$id = SiblingDiscount::find()->where(['id'=> $id])->all();
        }

        if($id === 0){
            $calc = $percent . ' x ' . $tuition . ' = ' . 0;
            $td = (float) $bd + (float) $hd;
        } else {
            $tuition = number_format($t, 2);
            $td = (float) $sd + (float) $bd + (float) $hd;
            $calc = $percent . ' x ' . $tuition . ' = ' . number_format(($p/100 * $t), 2);
            
        }


        $data = (object) array('value' => $value, 'id' => $id, 'calc' => $calc , 'sb' => $sb, 'bd' => $bd, 'hd' => $hd, 'td' => $td);

        return $data;
    }

    public function actionDlist($id, $t, $bd, $hd){

        if(Yii::$app->request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;

            $id = SiblingDiscount::find()->where(['id'=> $id])->all();
            $p = $id[0]['percentage_value'];
            $percent = $id[0]['percentage_value'] . '%';
            $tuition = number_format($t, 2);

            $calc = $percent . ' x ' . $tuition . ' = ' . number_format(($p/100 * $t), 2);
            
            $sb = round($p/100 * $t, 3);
            $bd = (float) $bd;
            $hd = (float) $hd;
            $td = $sb + $bd + $hd;

            $data = (object) array('id' => $id, 'calc' => $calc , 'sb' => $sb, 'bd' => $bd, 'hd' => $hd, 'td' => $td);

            return $data;
        }
    }

    public function actionNew($eid)
    {
        $eid = (int) $eid;
        $id = EnrolledForm::findOne($eid);

        if($id !== null){
            $model = new AssessmentForm();
            $student_id = (int) $id->student_id;
            $grade_level_id = (int) $id->grade_level_id;
            $student = StudentForm::findOne($id->student_id);
            $tuition = Tuition::find()->where(['grade_level_id' => $grade_level_id])->orderBy(['id' => SORT_DESC])->all();
            $model->enrolled_id = $eid;
            $tid = (int) $tuition[0]['id'];
            $model->tuition_id = $tid;
            $model->has_sibling_discount = (int) $model->has_sibling_discount;
            $model->has_book_discount = (int) $model->has_book_discount;
            $model->has_honor_discount = (int) $model->has_honor_discount;

            if(!empty($tuition)){
                $array = $tuition;
                /*for($i = 0; $i < count($tuition); $i++) {
                    $array[$i] = $tuition[$i];
                }*/
            } else {
                throw new NotFoundHttpException('Oops, Something went wrong.');
            }

            //$tuition_detail = Tuition::find()->where(['grade_level_id' => $grade_level_id])->orderBy(['id' => SORT_DESC])->all();
            
            if ($model->load(Yii::$app->request->post()) && $model->save() ){
                
                //die(print_r($_POST));
                /*if($model->has_sibling_discount === 0){
                    $student->has_sibling_enrolled = 0;
                    $student->save();
                }*/

                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('new', [
                    'model' => $model,
                    'student' => $student,
                    'tid' => $tid,
                    'array' => $array,
                ]);
            }
        }else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Updates an existing AssessmentForm model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $eid = (int) $model->enrolled_id;
        $id = EnrolledForm::findOne($eid);

        $student_id = (int) $id->student_id;
        $grade_level_id = (int) $id->grade_level_id;
        $student = StudentForm::findOne($student_id);
        $tuition = Tuition::find()->where(['grade_level_id' => $grade_level_id])->orderBy(['id' => SORT_DESC])->all();
        $tid = (int) $tuition[0]['id'];

        if(!empty($tuition)){
            $array = $tuition;
        } else {
            throw new NotFoundHttpException('Oops, Something went wrong.');
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            return $this->redirect(['view', 'id' => $model->id]);
        } else {

            return $this->render('update', [
                'model' => $model,
                'array' => $array,
                'student' => $student,
                'tuition' => $tuition,
                'tid' => $tid,
            ]);
        }
    }

    /**
     * Deletes an existing AssessmentForm model.
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
     * Finds the AssessmentForm model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return AssessmentForm the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AssessmentForm::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findTuition($id)
    {
        if (($model = Tuition::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
