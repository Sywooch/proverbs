<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\User;
use app\models\Board;
use app\models\BoardSearch;
use app\models\StudentForm;
use app\models\Announcement;
use app\models\PaymentForm;
use app\models\ApplicantForm;
use app\models\EnrolledForm;
use app\models\SchoolYear;

class DashboardController extends Controller
{

    public function behaviors(){
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => false,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'sbar' => ['post']
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    protected function findBoard($id)
    {
        if (($board = Board::findOne($id)) !== null) {
            return $board;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function countStudents(){
        $count = count(StudentForm::find()->where(['status' => 1])->all());

        return $count;
    }

    public function countUsers(){
        $count = count(User::find()->all());

        return $count;
    }

    public function countAnnouncement(){
        $count = count(Announcement::find()->all());

        return $count;
    }

    public function countBoard(){
        $count = count(Board::find()->all());

        return $count;
    }

    public function countApplicant(){
        $count = count(ApplicantForm::find()->where(['status' => 2])->all());
        
        return $count;
    }

    public function countCurrentEnrolled(){
        $latest = (int) SchoolYear::find()->orderBy(['id' => SORT_DESC])->all()[0]['id'];
        $count = count(EnrolledForm::find()->where(['sy_id' => $latest])->where(['enrollment_status' => 0])->all());
        
        return $count;
    }
}
