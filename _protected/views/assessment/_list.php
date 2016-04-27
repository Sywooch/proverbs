<?php
use yii\helpers\Html;
use app\models\DataHelper;
$avatar = Yii::$app->request->baseUrl . Yii::$app->params['avatar'];
!empty($model->enrolled->student->students_profile_image) ? $img = Yii::$app->request->baseUrl . '/uploads/students/' . $model->enrolled->student->students_profile_image : $img = $avatar;
!empty(trim($model->enrolled->student->middle_name)) ? $middle = ucfirst(substr($model->enrolled->student->middle_name, 0,1)).'.' : $middle = '';
?>

<div class="right floated content"><?= Html::a('<i class="pencil icon"></i>', ['update', 'id' => $model->id]) ?></div>
<div class="ui tiny rounded image">
	<img src="<?= $img ?>" style="background: #e9eaed;">
</div>
<div class="content">
	<label><strong><?= Html::a(implode(' ', ['ID#', $model->id]),['view', 'id' => $model->id],[]) ?></strong></label><br>
	<h6 style="margin: 0 auto;"><?= DataHelper::name($model->enrolled->student->first_name, $model->enrolled->student->middle_name, $model->enrolled->student->last_name) ?></h6>
	<div class="extra content">
		<span><?= DataHelper::gradeLevel($model->enrolled->student->grade_level_id) ?><?= $model->enrolled->student->sped === 0 ? '&nbsp;<div class="ui star rating" data-rating="1"><i class="icon star active"></i></div>' : ''?></span><br>
		<span><?= DataHelper::enrolleeStatus($model->enrolled->enrollment_status) ?></span>
	</div>
</div>