<?php
use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;
$this->title = 'Dashboard';
?>
<div class="ui container">
	<h1>Welcome <?= ucfirst(Yii::$app->user->identity->username) ?></h1>
</div>