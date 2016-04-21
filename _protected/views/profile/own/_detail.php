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
						'id',
						'first_name',
						'middle_name',
						'last_name',
						[
							'attribute' => 'gender',
							'value' => $model->getGenderName($model->gender)
						],
						'birth_date:date',
						'address',
						'phone',
						'mobile',
					],
				]);
			?>
		<?php Pjax::end(); ?>
</div>