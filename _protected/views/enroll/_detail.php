<?php
use yii\helpers\ArrayHelpers;
use yii\helpers\Html;
use app\models\UiTable;
use yii\widgets\Pjax;

$avatar = Yii::$app->request->baseUrl . Yii::$app->params['avatar'];
!empty($model->student->students_profile_image) ? $img = Yii::$app->request->baseUrl . '/uploads/students/' . $model->student->students_profile_image : $img = $avatar;
?>
<?php Pjax::begin(['id' => 'enroll-detail', 'timeout' => 60000]); ?>
<div class="ui segment">
	<div class="ui inverted dimmer">
	    <div class="ui massive text loader"></div>
	</div>
	<?= Html::a('New Payment',['/payments/new', 'sid' => $model->student->id, 'aid' => $assessment['id']],['class' => 'ui right floated big basic button'])?>
	<?= Html::a('View Assessment',['/assessment/view', 'id' => $assessment['id']],['class' => 'ui right floated big basic button'])?>
	<br><br>
	<?= UiTable::widget([
	    'model' => $model,
	    'options' => ['class' => 'ui fixed very basic table'],
	    'attributes' => [
		    	[
		    		'attribute' => 'enrollment_status',
		    		'value' => $model->statusName
		    	],
		    	'student_id',
		    	[
		    		'attribute' => 'student',
		    		'value' => implode(' ',[$model->student->first_name, !empty(trim($model->student->middle_name)) ? $middle = ucfirst(substr($model->student->middle_name, 0,1)).'.' : $middle = '',$model->student->last_name,])
		    	],
		    	[
		    		'attribute' => 'grade_level_id',
		    		'value' => $model->levelName
		    	],
		    	[
		    		'attribute' => 'section_id',
		    		'value' => $model->section->section_name
		    	],
	    	]
	])?>
</div>
<?php Pjax::end(); ?>