<?php
use yii\helpers\ArrayHelpers;
use yii\helpers\Html;
use app\models\UiTable;
use yii\widgets\Pjax;
?>
<div class="ui segment">
        <?php Pjax::begin(['id' => 'user-detail', 'timeout' => 10000, 'enablePushState' => false, 'enableReplaceState' => true]); ?>
			<div class="ui inverted dimmer">
			    <div class="ui massive text loader"></div>
			</div>
			<?=
				UiTable::widget([
					'model' => $model,
					'options' => ['class' => 'ui fixed very basic table'],
					'attributes' => [
						[
							'attribute' => 'status',
							'value' => $model->getStatusName($model->status)
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
			                'attribute'=>'status',
			                'value' => $model->getStatusName(),
			            ],
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
				]);
			?>
		<?php Pjax::end(); ?>
</div>