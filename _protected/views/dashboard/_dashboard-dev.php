<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;
use yii\widgets\Pjax;
use yii\imagine\Image;
use app\models\Board;
use app\models\DataCenter;
use app\models\SchoolYear;
use yii\bootstrap\Alert;
$this->title = 'Dashboard';
?>
<div class="page-header">
	<div class="page-title">
		<h3 style="margin: 0; padding: 0;">Dashboard <small>Welcome <?= ucfirst(Yii::$app->user->identity->username) ?>. <?= \Carbon\Carbon::createFromTimestamp(DataCenter::lastLogout(), 'Asia/Manila')->diffForHumans() ?> since last visit</small></h3>
	</div>
</div>
<br>
<div class="ui fluid segment">
	<?php
		//echo Html::img();
		//$thumb = new Image();
		//$thumb->open(Url::to(['/file', 'id' => Yii::$app->user->identity->profile_image]));    
		// //$thumb->resizeImage(32,32,Imagick::FILTER_LANCZOS,1);
		// // $thumb->writeImage('mythumb.gif');
		// // $thumb->clear();
		// // $thumb->destroy();
	?>
</div>