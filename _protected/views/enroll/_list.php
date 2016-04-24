<?php
use yii\helpers\Html;

$avatar = Yii::$app->request->baseUrl . Yii::$app->params['avatar'];
!empty($model->student->students_profile_image) ? $img = Yii::$app->request->baseUrl . '/uploads/students/' . $model->student->students_profile_image : $img = $avatar;
!empty(trim($model->student->middle_name)) ? $middle = ucfirst(substr($model->student->middle_name, 0,1)).'.' : $middle = '';
?>

<div class="right floated content"><?= Html::a('<i class="pencil icon"></i>', ['update?id=' . $model->id]) ?></div>
<div class="ui tiny rounded image">
	<img src="<?= $img ?>" style="background: #e9eaed;">
</div>
<div class="content">
	<label>ID#: <strong><?= $model->student_id ?></strong></label><br>
	<?= Html::a(implode(' ', [$model->student->first_name, $middle, $model->student->last_name]),['view', 'id' => $model->id], ['class' => 'header full-name']) ?>
	<br>
	<div class="extra content">
		<span><?= $model->levelName ?></span>
		<p></p>
		<span><?= $model->statusName ?></span>
	</div>
</div>