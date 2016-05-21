
<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;
use yii\widgets\Pjax;
use app\models\Board;
use app\models\DataCenter;
use app\models\SchoolYear;
use yii\bootstrap\Alert;
use yii\imagine\Image;
use app\models\File;

$this->title = 'Dashboard';
?>
<div class="page-header">
	<div class="page-title">
		<h3 style="margin: 0; padding: 0;">Dashboard <small>Welcome <?= ucfirst(Yii::$app->user->identity->username) ?>!</small></h3>
	</div>
</div>
<br>
<div class="ui fluid segment">

</div>