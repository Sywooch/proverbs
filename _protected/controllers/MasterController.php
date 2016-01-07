<?php

namespace app\controllers;

use app\controllers\Exception;
use app\rbac\models\AuthAssignment;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Html;
use yii\web\Controller;
use Yii;


class MasterController extends Controller
{
	public function behaviors()
	{
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
	}

    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) 
        {
            return $this->redirect('site/login');
        }
        
        return $this->render('index');
    }
}
