<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Board;
use app\models\BoardSearch;

class DashboardController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'board' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $board = new Board();
        
        $board->posted_by = Yii::$app->user->id;

        if ($board->load(Yii::$app->request->post()))
        {
            if(empty($board->content) || $board->content === null || trim($board->content) === ''){
                $board = new Board(); //reset model
            } else {
                $board->save();
                $board = new Board(); //reset model
            }
        }

        return $this->render('index',[
            'board' => $board,
        ]);
    }

    public function actionPull()
    {
        $searchBoardModel = new BoardSearch();
        $dataProviderBoard = $searchBoardModel->searchBoard(Yii::$app->request->queryParams);

        return $this->render('index',[
            'searchBoardModel' => $searchBoardModel,
            'dataProviderBoard' => $dataProviderBoard,
            'board' => $board,
        ]);
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
