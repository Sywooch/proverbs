<?php 
use yii\helpers\Html;
use app\models\DataHelper;
?>

<div class="right floated content"><?= Html::a('<i class="pencil icon"></i>', ['update', 'id' => $model->id]) ?></div>
<div class="ui tiny rounded image">
	<?php if(!empty($model->teacher->profile_image)) : ?>
		<?= Html::img(['/uthumbnail','id'=>$model->teacher->profile_image]) ?>
	<?php else :?>
		<?= Html::img([Yii::$app->params['avatar'], ['alt' => 'user']]) ?>
	<?php endif ?>
</div>
<div class="content">
	<label><strong><?= Html::a(implode('', ['#', $model->id]),['view', 'id' => $model->id],[]) ?></strong></label><br>
	<h6 style="margin: 0 auto;"><?= DataHelper::name($model->teacher->first_name, $model->teacher->middle_name, $model->teacher->last_name) ?></h6>
	<div class="meta"><strong><small><?= $model->subject->subject_name ?></small></strong></div>
	<div class="extra content">
		<span><?= $model->section->section_name ?></span><br>
	</div>
</div>