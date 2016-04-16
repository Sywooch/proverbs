<?php
use yii\helpers\Html;

$def = Yii::$app->request->baseUrl . '/uploads/ui/user-blue.png';
!empty($model->students_profile_image) ? $img = Yii::$app->request->baseUrl . '/uploads/students/' . $model->students_profile_image : $img = $def;
$model->gender === 0 ? $gender = 'Male <i class="man icon"></i>' : $gender = 'Female <i class="woman icon"></i>';
!empty(trim($model->middle_name)) ? $middle = ucfirst(substr($model->middle_name, 0,1)).'.' : $middle = '';
?>

<div class="right floated content"><?= Html::a('<i class="pencil icon"></i>', ['update?id=' . $model->id]) ?></div>
<div class="ui tiny rounded image">
	<img src="<?= $img ?>" style="background: #e9eaed;">
</div>
<div class="content">
	<label>ID# <strong><?= $model->id ?></strong></label><br>
	<?= Html::a(implode(' ', [$model->first_name, $middle, $model->last_name]),['view?id=' . $model->id], ['class' => 'header full-name']) ?>
	<br>
	<div class="extra content">
		<span><?= $model->gradeLevel->name ?></span>
	</div>
</div>
