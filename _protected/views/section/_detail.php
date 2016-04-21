<?php
use yii\helpers\ArrayHelpers;
use yii\helpers\Html;
use app\models\UiTable;
?>

<div class="ui segment">
	<?= UiTable::widget([
		    'model' => $model,
		    'options' => ['class' => 'ui fixed very basic table'],
		    'attributes' => [
		    	'section_name',
		    	[
		    		'attribute' => 'grade_level_id',
		    		'value' => $model->getLeveLName($model->grade_level_id)
		    	],
		    ]
    ])?>
</div>