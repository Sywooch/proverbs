<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use app\models\User;
use app\models\Board;
use app\models\BoardSearch;

class AjaxController extends Controller
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
	
	public function actionIndex() {
		//return $this->redirect('../dashboard');
		return $this->render('ajax');
	}

	public function actionFetch() {

		if (Yii::$app->request->isAjax) {
			Yii::$app->response->format = Response::FORMAT_JSON;
			
			$now = time();
			$from = $now - (2 * 24 * 60 * 60);
			$object = Board::find()->where(['between' ,'created_at' , $from, $now])->orderBy(['id' => SORT_ASC])->all();
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

	public function actionLinkForm() {
		if (Yii::$app->request->isAjax) {
			Yii::$app->response->format = Response::FORMAT_JSON;
			$res = array(
				'body'    => print_r($_POST, true),
				'success' => true,
			);
			return $res;
		}
	}
}