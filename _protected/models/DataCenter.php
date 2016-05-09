<?php

namespace app\models;

use app\models\Announcement;
use app\models\AnnouncementSearch;
use app\models\Board;
use app\models\BoardSearch;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

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
        $count = count(Board::find()->all());
		
		return $count;
	}

	public function recentAnnouncement($size){
        $searchModel = new AnnouncementSearch();
        $dataProvider = $searchModel->searchRecentAnnouncement($params = null, $size);

		return $dataProvider;
	}

	public function recentBoard($size){
        $searchModel = new BoardSearch();
        $dataProvider = $searchModel->searchRecentBoard($params = null, $size);

		return $dataProvider;
	}

	public function countRecentAnnouncement(){
        $count = count(Announcement::find()->all());
		
		return $count;
	}
}
