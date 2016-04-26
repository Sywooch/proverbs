<?php
use yii\helpers\Html;

$avatar = Yii::$app->request->baseUrl . Yii::$app->params['avatar'];
!empty($model->enrolled->student->students_profile_image) ? $img = Yii::$app->request->baseUrl . '/uploads/students/' . $model->enrolled->student->students_profile_image : $img = $avatar;
!empty(trim($model->enrolled->student->middle_name)) ? $middle = ucfirst(substr($model->enrolled->student->middle_name, 0,1)).'.' : $middle = '';
?>

<div class="right floated content"><?= Html::a('<i class="pencil icon"></i>', ['update', 'id' => $model->id]) ?></div>
<div class="ui tiny rounded image">
	<img src="<?= $img ?>" style="background: #e9eaed;">
</div>
<div class="content">
	<label>ID#: <strong><?= $model->enrolled->student->id ?></strong></label><br>
	<?= Html::a(implode(' ', [$model->enrolled->student->first_name, $middle, $model->enrolled->student->last_name]),['view', 'id' => $model->id], ['class' => 'header full-name']) ?>
	<br>
	<div class="extra content">
		<span><?= $model->enrolled->student->gradeLevel->name ?></span>
		<p></p>
		<span><?= $model->getEnrollmentStatus($model->enrolled->enrollment_status) ?></span>
	</div>
</div>