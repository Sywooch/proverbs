<?php
use yii\helpers\Html;

?>
<div class="right floated content"><?= Html::a('<i class="pencil icon"></i>', ['update?id=' . $model->id]) ?></div>
<div class="ui tiny rounded image">
	<div class="section-wrap">
		<div class="section-minify">
			<h4><?= $model->getLevelName() ?></h4>
		</div>
	</div>
</div>
<div class="content">
	<label><strong></strong></label><br>
	<?= Html::a($model->section_name, ['view?id=' . $model->id], ['class' => 'header full-name']) ?>
	<br>
	<div class="extra content">
		<span><?= $model->gradeLevel->name ?></span>
	</div>
</div>