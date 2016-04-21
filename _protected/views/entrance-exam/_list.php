<?php
use yii\helpers\Html;

$avatar = Yii::$app->request->baseUrl . Yii::$app->params['avatar'];
!empty($model->applicant['students_profile_image']) ? $img = Yii::$app->request->baseUrl . '/uploads/students/' . $model->applicant['students_profile_image'] : $img = $avatar;
!empty(trim($model->applicant['middle_name'])) ? $middle = ucfirst(substr($model->applicant['middle_name'], 0,1)).'.' : $middle = '';
?>
<div class="right floated content"><?= Html::a('<i class="pencil icon"></i>', ['update?id=' . $model->id]) ?></div>
<div class="ui tiny rounded image">
	<img src="<?= $img ?>" style="background: #e9eaed;">
</div>
<div class="content">
	<label>ID# <strong><?= $model->applicant_id ?></strong></label><br>
	<?= Html::a(implode(' ', [$model->applicant['first_name'], $middle, $model->applicant['last_name']]),['view?id=' . $model->id], ['class' => 'header full-name']) ?>
	<br>
	<div class="extra content">
		<span><?= $model->getGradeLevelName($model->applicant['grade_level_id']) ?> </span>
	</div>
</div>