<?php
namespace app\models;

use Yii;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\rbac\models\AuthAssignment;
use app\models\Users;
use app\models\ApplicantForm;
use app\models\SchoolYear;

class DataStats
{

    public static function countUsers(){
        $count = count(User::find()->all());

        return $count;
    }

    public static function countNewApplicants(){
        $latest = SchoolYear::find()->orderBy(['id' => SORT_ASC])->one();
        //$count = count(ApplicantForm::find()->all()->where(['']));

        return $latest;
    }
    public static function countTotalApplicants(){
        $count = count(User::find()->all());

        return $count;
    }
    public static function getLatestSchoolYear(){
        $latest = SchoolYear::find()->orderBy(['id' => SORT_DESC])->one();
        return $latest;
    }
}
