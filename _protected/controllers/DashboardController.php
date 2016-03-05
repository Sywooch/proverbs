<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\User;
use app\models\Board;
use app\models\BoardSearch;

class DashboardController extends Controller
{
    public $jsFile;

    public function init() {
        parent::init();

        $this->jsFile = '@app/views/' . $this->id . '/ajax.js';
        Yii::$app->assetManager->publish($this->jsFile);
        $this->getView()->registerJsFile(
            Yii::$app->assetManager->getPublishedUrl($this->jsFile),
            ['yii\web\YiiAsset'] // depends
        );
    }

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'fetch' => ['post'],
                ],
            ],
        ];
    }

    public function actionFetch() {

        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            
            $now = time();
            $from = $now - (7 * 24 * 60 * 60);
            $object = Board::find()->where(['between' ,'created_at' , 1452152449, $now])->orderBy(['id' => SORT_ASC])->all();
            $data = array();

            //CURRENT USER
            $id = array('uid' => Yii::$app->user->identity->id); 
            $img = array('uimg' => Yii::$app->user->identity->profile_image);
            $sg = array('ug' => Yii::$app->user->identity->gender);
            $base = array('url' => Yii::$app->request->hostInfo);

            for($i = 0; $i < count($object); $i++){
                $object[$i]['content'] = Html::encode($object[$i]['content']);
                $username = User::findOne(['id' => $object[$i]['posted_by']])->username;
                $gender = User::findOne(['id' => $object[$i]['posted_by']])->gender;
                $profile_image = User::findOne(['id' => $object[$i]['posted_by']])->profile_image;

                $data[$i] = array('value' => ['username' => $username, 'gender' => $gender, 'profile_image' => $profile_image]); //POSTED BY OTHER USER
            }

            return array('object' => $object, 'data' => $data, 'id' => $id, 'foto' => $img, 'base' => $base);
        }
    }

    public function actionIndex()
    {
/*        $board = new Board();
        
        $board->posted_by = Yii::$app->user->id;

        if ($board->load(Yii::$app->request->post()))
        {
            if(empty($board->content) || $board->content === null || trim($board->content) === ''){
                $board = new Board(); //reset model
                return $this->render('index',[
                    'board' => $board,
                ]);
            } else {
                $board->save();
                $board = new Board(); //reset model
                return $this->render('index',[
                    'board' => $board,
                ]);
            }
        }*/

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
}
