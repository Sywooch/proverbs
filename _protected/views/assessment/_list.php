<?php
use yii\helpers\Html;
use app\models\DataHelper;
!empty(trim($model->enrolled->student->middle_name)) ? $middle = ucfirst(substr($model->enrolled->student->middle_name, 0,1)).'.' : $middle = '';
?>
<div class="right floated content"><?= Html::a('<i class="pencil icon"></i>', ['update', 'id' => $model->id]) ?></div>
<div class="ui tiny rounded image">
	<?php if(!empty($model->enrolled->student->students_profile_image)) : ?>
		<?= Html::img(['/thumbnail','id'=>$model->enrolled->student->students_profile_image]) ?>
	<?php else :?>
		<?= Html::img([Yii::$app->params['avatar'], ['alt' => 'user']]) ?>
	<?php endif ?>
</div>
<div class="content">
	<label><strong><?= Html::a(implode('', ['#', $model->id]),['view', 'id' => $model->id],[]) ?></strong></label><br>
	<h6 style="margin: 0 auto;"><?= DataHelper::name($model->enrolled->student->first_name, $model->enrolled->student->middle_name, $model->enrolled->student->last_name) ?></h6>
	<div class="meta"><strong><small><?= implode(' ',['ID# ',$model->enrolled->student->id]) ?></small></strong></div>
	<div class="extra content">
		<span><?= DataHelper::gradeLevel($model->enrolled->student->grade_level_id) ?><?= $model->enrolled->student->sped === 0 ? '&nbsp;<div class="ui star rating" data-rating="1"><i class="icon star active"></i></div>' : ''?></span><br>
		<span><?= DataHelper::enrolleeStatus($model->enrolled->enrollment_status) ?></span>
	</div>
</div>