<?php
use yii\helpers\Html;
use app\models\DataHelper;
$avatar = Yii::$app->request->baseUrl . Yii::$app->params['avatar'];
?>
<div class="right floated content"><?= Html::a('<i class="pencil icon"></i>', ['update?id=' . $model->id]) ?></div>
<div class="content">
	<label><strong><?= Html::a(implode(' ', ['ID#', $model->id]),['view', 'id' => $model->id],[]) ?></strong></label><br>
	<h6 style="margin: 0 auto;"><?= $model->user->username ?></h6>
	<div class="extra content">
		<span><?= $model->request_text ?></span><br>
		<span><?= DataHelper::requestStatus($model->request_status) ?></span>
	</div>
</div>
