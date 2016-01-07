<?php

namespace app\controllers;

use app\rbac\models\AuthAssignment;

class PrincipalController extends \yii\web\Controller
{
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) 
        {
            return $this->redirect('site/login');
        }
        
        return $this->render('index');
    }

}
