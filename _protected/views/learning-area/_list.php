<?php
use yii\helpers\Html;

?>
<div class="right floated content"><?= Html::a('<i class="pencil icon"></i>', ['update?id=' . $model->id]) ?></div>
<div class="content">
	<label><strong><?php // Html::a(implode('', ['#', $model->id]),['view', 'id' => $model->id],[]) ?></strong></label><br>
	<h6 style="margin: 0 auto;"><?= $model->subject->subject_name ?></h6>
	<br>
	<div class="extra content">
		<span><?= $model->gradeLevel->name ?></span>
	</div>
</div>