<?php
namespace app\models;

use Yii;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\rbac\models\AuthAssignment;
use app\models\Users;

class DataStats
{

    public static function countUsers(){
        $count = count(User::find()->all());

        return $count;
    }
}
