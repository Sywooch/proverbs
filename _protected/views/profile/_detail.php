<?php
use yii\helpers\ArrayHelpers;
use yii\helpers\Html;
use app\models\UiTable;
use yii\widgets\Pjax;
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