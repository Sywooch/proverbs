<?php
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ListView;
$this->title = 'Dashboard';
?>
<div class="row">
	<div class="col-lg-12">
		<div class="row">
			<div class="col-lg-8 col-md-8 col-sm-12">
				<h1>Welcome <?= ucfirst(Yii::$app->user->identity->username) ?></h1>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-12">
			</div>
		</div>
	</div>
</div>