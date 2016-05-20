<?php
use yii\helpers\Html;
?>

<div class="right floated content"><?= Html::a('<i class="pencil icon"></i>', ['update?id=' . $model->id]) ?></div>
<div class="ui tiny rounded image">
	<?php if(!empty($model->profile_image)) : ?>
		<?= Html::img(['/uthumbnail','id'=>$model->profile_image]) ?>
	<?php else :?>
		<?= Html::img([Yii::$app->params['avatar'], ['alt' => 'user']]) ?>
	<?php endif ?>
</div>
<div class="content">
	<label><strong><?= $model->email ?></strong></label><br>
	<?= Html::a($model->username,['view?id=' . $model->id], ['class' => 'header full-name']) ?>
	<br>
	<div class="extra content">
		<span><?= ucfirst($model->role->item_name) ?></span>
	</div>
</div>