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
	<label><strong><?= Html::a(implode(' ', ['ID#', $model->id]),['view', 'id' => $model->id],[]) ?></strong></label><br>
	<h6 style="margin: 0 auto;"><?= implode(' ', [$model->applicant['first_name'], $middle, $model->applicant['last_name']]) ?></h6>
	<div class="extra content">
		<span><?= $model->getGradeLevelName($model->applicant['grade_level_id']) ?><?= $model->applicant['sped'] === 0 ? '&nbsp;<div class="ui star rating" data-rating="1"><i class="icon star active"></i></div>' : ''?></span><br>
		<span>&nbsp;</span>
	</div>
</div>