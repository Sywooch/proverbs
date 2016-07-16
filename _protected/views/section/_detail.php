<?php
use yii\helpers\ArrayHelpers;
use yii\helpers\Html;
use app\models\UiTable;
use yii\widgets\Pjax;
?>
<?php Pjax::begin(['id' => 'section-detail', 'timeout' => 60000]); ?>
<div class="ui segment">
	<div class="ui inverted dimmer">
	    <div class="ui massive text loader"></div>
	</div>
	<?= UiTable::widget([
		    'model' => $model,
		    'options' => ['class' => 'ui fixed very basic table'],
		    'attributes' => [
		    	'section_name',
		    	[
		    		'attribute' => 'grade_level_id',
		    		'value' => $model->getLeveLName($model->grade_level_id)
		    	],
		    	'created_at:date',
		    	'updated_at:date',
		    ]
    ])?>
    <?php Pjax::end(); ?>
</div>
