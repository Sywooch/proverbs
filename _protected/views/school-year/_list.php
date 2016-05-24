<?php
use yii\helpers\Html;

?>
<div class="right floated content"><?= Html::a('<i class="pencil icon"></i>', ['update?id=' . $model->id]) ?></div>
<div class="content">
	<label><strong>#<?= $model->id?></strong></label><br>
	<?= Html::a($model->sy,['view','id' => $model->id],[]) ?>
	<br>
	<div class="extra content">
		<span></span>
	</div>
</div>