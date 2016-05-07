<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use app\models\Announcement;
use app\models\Board;

class DataCenter
{
	public function announcement(){
        $searchModel = new AnnouncementSearch();
        $dataProvider = $searchModel->searchAnnouncement($params = null);

		return $dataProvider;
	}

	public function board(){
        $searchModel = new BoardSearch();
        $dataProvider = $searchModel->searchBoard($params = null);

		return $dataProvider;
	}

	public function countAnnouncement(){
        $count = count(Announcement::find()->all());
		
		return $count;
	}

	public function countBoard(){
        $count = Board::count();
		
		return $count;
	}
}
