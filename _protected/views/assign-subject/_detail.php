<?php
use yii\helpers\ArrayHelpers;
use yii\helpers\Html;
use app\models\UiTable;
use app\models\DataHelper;
use yii\widgets\Pjax;
?>
<?php Pjax::begin(['id' => 'assign-subject-detail', 'timeout' => 60000]); ?>
<div class="ui segment">
	<div class="ui inverted dimmer">
	    <div class="ui massive text loader"></div>
	</div>
	<?= UiTable::widget([
	    'model' => $model,
	    'options' => ['class' => 'ui fixed very basic table'],
	    'attributes' => [
	    	[
	    		'attribute' => 'sy_id',
	    		'value' => DataHelper::schoolYear($model->sy_id)
	    	],
	    	[
	    		'attribute' => 'teacher_id',
	    		'value' => DataHelper::name($model->teacher->first_name, $model->teacher->middle_name, $model->teacher->last_name)
	    	],
	    	[
	    		'attribute' => 'grade_level_id',
	    		'value' => $model->gradeLevel->name
	    	],
	    	'section.section_name'
    	]
	])?>
</div>
<?php Pjax::end(); ?>