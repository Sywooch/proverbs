<?php
use yii\helpers\Html;
use yii\widgets\Pjax;
use app\models\DataHelper;
$avatar = Yii::$app->request->baseUrl . Yii::$app->params['avatar'];
!empty($model->profile_image) ? $img = Yii::$app->request->baseUrl . '/uploads/users/' . $model->profile_image : $img = $avatar;
?>
<?php Pjax::begin(['id' => 'profile-card', 'timeout' => 60000]); ?>
<div class="ui center aligned stackable cards">
	<div class="card">
		<div class="image"><img src="<?= $img ?>" class="tiny image"></div>
		<div class="ui center aligned content">
			<label><em><?= $model->email ?></em></label>
			<div class="header">
				<?= DataHelper::name($model->first_name, $model->middle_name, $model->last_name) ?>
				<p></p>
			</div>
			<div class="meta">
				<span id="meta-content"><?= implode('', ['\'', $model->username, '\'']) ?></span>
				<p></p>
			</div>
		</div>
		<div class="extra center aligned content">
			<label class="user-id"><span><?= ucfirst($model->role->item_name) ?></span></label>
		</div>
	</div>
</div>
<?php Pjax::end(); ?>