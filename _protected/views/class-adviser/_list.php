<?php
use yii\helpers\Html;
use app\models\DataHelper;
$avatar = Yii::$app->request->baseUrl . Yii::$app->params['avatar'];
!empty($model->teacher->profile_image) ? $img = Yii::$app->request->baseUrl . '/uploads/users/' . $model->teacher->profile_image : $img = $avatar;
!empty(trim($model->teacher->middle_name)) ? $middle = ucfirst(substr($model->teacher->middle_name, 0,1)).'.' : $middle = '';
?>
<div class="right floated content"><?= Html::a('<i class="pencil icon"></i>', ['update', 'id' => $model->id]) ?></div>
<div class="ui tiny rounded image">
	<img src="<?= $img ?>" style="background: #e9eaed;">
</div>
<div class="content">
	<label><strong><?= Html::a('ID#: '. $model->id,['view', 'id' => $model->id]) ?></strong></label>
	<div class="ui medium header"><?= DataHelper::name($model->teacher->first_name, $model->teacher->middle_name, $model->teacher->last_name) ?></div>
	<div class="extra content">
		<span><?= DataHelper::gradeLevel($model->grade_level_id) ?></span><br/>
		<span><?= DataHelper::section($model->section_id) ?></span>
	</div>
</div>