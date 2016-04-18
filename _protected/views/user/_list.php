<?php
use yii\helpers\Html;

$def = Yii::$app->request->baseUrl . '/uploads/ui/user-blue.png';
!empty($model->profile_image) ? $img = Yii::$app->request->baseUrl . '/uploads/users/' . $model->profile_image : $img = $def;
?>

<div class="right floated content"><?= Html::a('<i class="pencil icon"></i>', ['update?id=' . $model->id]) ?></div>
<div class="ui tiny rounded image">
	<img src="<?= $img ?>" style="background: #e9eaed;">
</div>
<div class="content">
	<label><strong><?= $model->email ?></strong></label><br>
	<?= Html::a($model->username,['view?id=' . $model->id], ['class' => 'header full-name']) ?>
	<br>
	<div class="extra content">
		<span><?= ucfirst($model->role->item_name) ?></span>
	</div>
</div>