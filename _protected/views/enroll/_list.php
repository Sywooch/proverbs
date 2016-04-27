<?php
use yii\helpers\Html;
use app\models\DataHelper;
$avatar = Yii::$app->request->baseUrl . Yii::$app->params['avatar'];
!empty($model->student->students_profile_image) ? $img = Yii::$app->request->baseUrl . '/uploads/students/' . $model->student->students_profile_image : $img = $avatar;
!empty(trim($model->student->middle_name)) ? $middle = ucfirst(substr($model->student->middle_name, 0,1)).'.' : $middle = '';
?>

<div class="right floated content"><?= Html::a('<i class="pencil icon"></i>', ['update?id=' . $model->id]) ?></div>
<div class="ui tiny rounded image">
	<img src="<?= $img ?>" style="background: #e9eaed;">
</div>
<div class="content">
	<label><strong><?= Html::a(implode(' ', ['ID#', $model->id]),['view', 'id' => $model->id],[]) ?></strong></label><br>
	<h6 style="margin: 0 auto;"><?= implode(' ', [$model->student->first_name, $middle, $model->student->last_name]) ?></h6>
	<div class="extra content">
		<span><?= DataHelper::gradeLevel($model->grade_level_id) ?><?= $model->student->sped === 0 ? '&nbsp;<div class="ui star rating" data-rating="1"><i class="icon star active"></i></div>' : ''?></span><br>
		<span><?= DataHelper::enrolleeStatus($model->enrollment_status) ?></span>
	</div>
</div>