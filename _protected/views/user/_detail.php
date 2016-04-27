<?php
use yii\helpers\ArrayHelpers;
use yii\helpers\Html;
use app\models\UiTable;
use yii\widgets\Pjax;

$avatar = Yii::$app->request->baseUrl . Yii::$app->params['avatar'];
!empty($model->profile_image) ? $img = Yii::$app->request->baseUrl . '/uploads/students/' . $model->profile_image : $img = $avatar;
!empty($model->profile_image) ? $g = Yii::$app->request->baseUrl . '/uploads/guardians/' . $model->profile_image : $g = $avatar;
!empty(trim($model->middle_name)) ? $middle = ucfirst(substr($model->middle_name, 0,1)).'.' : $middle = '';
?>
<?php Pjax::begin(['id' => 'user-detail', 'timeout' => 60000]); ?>
<div class="ui segment">
	<div class="ui inverted dimmer">
	    <div class="ui massive text loader"></div>
	</div>
	<?= Html::a('View Profile',['/profile/view', 'id' => $profile->id],['class' => 'ui right floated huge basic button'])?>
	<?=	UiTable::widget([
		'model' => $model,
		'options' => ['class' => 'ui fixed very basic table'],
		'attributes' => [
			[
				'attribute' => 'status',
				'value' => $model->getStatusName()
			],
			[
				'attribute' => 'username',
				'value' => $model->username
			],
			[
				'attribute' => 'email',
				'value' => $model->email
			],
            'password_hash',
            [
                'attribute'=>'item_name',
                'value' => ucfirst($model->getRoleName()),
            ],
            'auth_key',
            'password_reset_token',
            'account_activation_token',
            'created_at:date',
            'updated_at:date',
		],
	]) ?>
<?php Pjax::end(); ?>
</div>
