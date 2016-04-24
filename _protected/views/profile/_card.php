<?php
use yii\helpers\Html;
use yii\widgets\Pjax;

$avatar = Yii::$app->request->baseUrl . Yii::$app->params['avatar'];
!empty($model->profile_image) ? $img = Yii::$app->request->baseUrl . '/uploads/users/' . $model->profile_image : $img = $avatar;
$model->gender === 0 ? $gender = 'Male' : $gender = 'Female';
!empty(trim($model->middle_name)) ? $middle = ucfirst(substr($model->middle_name, 0,1)).'.' : $middle = '';
?>
<?php Pjax::begin(['id' => 'profile-card', 'timeout' => 60000]); ?>
<div class="ui center aligned stackable cards">
	<div class="card">
		<div class="image"><img src="<?= $img ?>" class="tiny image"></div>
		<div class="ui center aligned content">
			<label><em><?= $model->email ?></em></label>
			<div class="header">
				<?= $model->username ?>
			</div>
		</div>
		<div class="extra content">
			<label class="left floated user-id"><span><?= ucfirst($model->role->item_name) ?></span></label>
		</div>
	</div>
</div>
<?php Pjax::end(); ?>