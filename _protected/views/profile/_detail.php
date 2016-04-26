<?php
use yii\helpers\ArrayHelpers;
use yii\helpers\Html;
use app\models\UiTable;
use yii\widgets\Pjax;

$avatar = Yii::$app->request->baseUrl . Yii::$app->params['avatar'];
!empty($model->profile_image) ? $img = Yii::$app->request->baseUrl . '/uploads/users/' . $model->profile_image : $img = $avatar;
!empty(trim($model->middle_name)) ? $middle = ucfirst(substr($model->middle_name, 0,1)).'.' : $middle = '';
?>
<?php Pjax::begin(['id' => 'profile-detail', 'timeout' => 60000]); ?>
<div class="ui segment">
	<div class="ui inverted dimmer">
	    <div class="ui massive text loader"></div>
	</div>
	<?= UiTable::widget([
		'model' => $model,
		'options' => ['class' => 'ui fixed very basic table'],
		'attributes' => [
			'username',
			'first_name',
			'middle_name',
			'last_name',
			'email',
			[
				'attribute' => 'gender',
				'value' => $model->getGenderName($model->gender)
			],
			'birth_date:date',
			'address',
			'phone',
			'mobile',
		],
	]); ?>
<?php Pjax::end(); ?>
</div>