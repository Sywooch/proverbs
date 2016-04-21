<?php
use yii\helpers\Html;
use yii\widgets\Pjax;
use app\rbac\models\AuthAssignment;
$avatar = Yii::$app->params['avatar'];
!empty($model->profile_image) ? $img = Yii::$app->request->baseUrl . '/uploads/users/' . $model->profile_image : $img = Yii::$app->request->baseUrl . $avatar;
?>
<?php Pjax::begin(['id' => 'user-card', 'timeout' => 10000, 'enablePushState' => false]); ?>
<div class="ui center aligned stackable cards">
	<div class="card">
		<div class="image"><img src="<?= $img ?>" class="tiny image"></div>
		<div class="ui center aligned content">
			<label>ID# <strong><?= $model->id ?></strong></label>
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