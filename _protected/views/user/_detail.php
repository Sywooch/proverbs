<?php
use yii\helpers\ArrayHelpers;
use yii\helpers\Html;
use app\models\UiTable;
use yii\widgets\Pjax;
?>
<div class="panel panel-default rounded-edge">
	<div class="panel-body">
		<?= Html::a('','#',['id' => 'trig', 'class' => 'hidden']) ?>
        <?php Pjax::begin(['id' => 'user-list', 'timeout' => 5000, 'enablePushState' => false]); ?>
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
			            [
			                'attribute' => 'updated_at',
			                'value' => $model->getUpdatedAt($model->updated_at)
			            ],
					],
				]);
			?>
		<?php Pjax::end(); ?>
	</div>
</div>
<?= $this->render('_pjax')?>