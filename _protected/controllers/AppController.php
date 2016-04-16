<?php
namespace app\controllers;

use yii\base\InvalidParamException;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\BadRequestHttpException;
use Yii;

class AppController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'controllers' => ['user'],
                        'actions' => ['index', 'view', 'create', 'update', 'delete'],
                        'allow' => false,
                        'roles' => ['parent'],
                    ],
                    [
                        'controllers' => ['user'],
                        'actions' => ['index', 'view', 'create', 'update', 'delete'],
                        'allow' => true,
                        'roles' => ['dev', 'master', 'admin'],
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
}
