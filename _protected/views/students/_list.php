<?php
use yii\helpers\Html;
use app\models\DataHelper;
$avatar = Yii::$app->request->baseUrl . Yii::$app->params['avatar'];
!empty($model->students_profile_image) ? $img = Yii::$app->request->baseUrl . '/uploads/students/' . $model->students_profile_image : $img = $avatar;
!empty(trim($model->middle_name)) ? $middle = ucfirst(substr($model->middle_name, 0,1)).'.' : $middle = '';
?>

<div class="right floated content"><?= Html::a('<i class="pencil icon"></i>', ['update?id=' . $model->id]) ?></div>
<div class="ui tiny rounded image">
	<?php if(!empty($model->students_profile_image)) : ?>
		<?= Html::img(['/thumbnail','id'=>$model->students_profile_image]) ?>
	<?php else :?>
		<?= Html::img([Yii::$app->params['avatar'], ['alt' => 'user']]) ?>
	<?php endif ?>
</div>
<div class="content">
	<label><strong><?= Html::a(implode(' ', ['ID#', $model->id]),['view', 'id' => $model->id],[]) ?></strong></label><br>
	<h6 style="margin: 0 auto;"><?= DataHelper::name($model->first_name, $model->middle_name, $model->last_name) ?></h6>
	<div class="extra content">
		<span><?= DataHelper::gradeLevel($model->grade_level_id) ?><?= $model->sped === 0 ? '&nbsp;<div class="ui star rating" data-rating="1"><i class="icon star active"></i></div>' : ''?></span><br>
		<span>&nbsp;</span>
	</div>
</div>
