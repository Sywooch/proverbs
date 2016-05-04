<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use app\models\Board;

class DataCenter
{
	public function board(){
        $searchModel = new BoardSearch();
        $dataProvider = $searchModel->searchBoard($params = null);

		return $dataProvider;
	}

	public function countBoard(){
        $count = Board::count();
		
		return $count;
	}
}
