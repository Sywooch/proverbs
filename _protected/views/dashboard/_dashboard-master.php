<?php
use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;
use app\models\DataCenter;
$this->title = 'Master';
use app\models\SchoolYear;
?>
<div class="ui fluid segment">
	<div class="page-header">
		<div class="page-title">
			<h3 style="margin: 0; padding: 0;">Dashboard <small>Welcome <?= ucfirst(Yii::$app->user->identity->username) ?>!</small></h3>
		</div>
	</div>
</div>