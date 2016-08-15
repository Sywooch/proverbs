<?php
use yii\helpers\ArrayHelpers;
use yii\helpers\Html;
use app\models\UiTable;
use app\models\DataHelper;
use yii\widgets\Pjax;
$avatar = Yii::$app->request->baseUrl . Yii::$app->params['avatar'];
!empty($model->student->students_profile_image) ? $img = Yii::$app->request->baseUrl . '/uploads/students/' . $model->student->students_profile_image : $img = $avatar;
?>
<?php Pjax::begin(['id' => 'enroll-detail', 'timeout' => 60000]); ?>
<div class="ui segment">
	<div class="ui inverted dimmer">
	    <div class="ui massive text loader"></div>
	</div>
	<?php if(DataHelper::checkIfEmpty($model->assessment_id, $model->assessment_id, 'NA') === 'NA'): ?>
		<div class="detail-button-wrap">&nbsp;</div>
	<?php else: ?>
		<div class="detail-button-wrap">
			<a class="ui right floated big basic button" href="/proverbs/assessment/view?id=<?=$model->assessment_id?>">View Assessment</a>
		</div>
	<?php endif ?>
	<?= UiTable::widget([
	    'model' => $model,
	    'options' => ['class' => 'ui fixed very basic table'],
	    'attributes' => [
	    		'id',
	    		[
	    			'attribute' => 'assessment_id',
	    			'value' => DataHelper::checkIfEmpty($model->assessment_id, $model->assessment_id, 'NA')
    			],
	    		[
	    			'attribute' => 'student_id',
	    			'value' => DataHelper::name($model->student->first_name, $model->student->middle_name, $model->student->last_name)
	    		],
	    		[
	    			'attribute' => 'transaction',
	    			'value' => DataHelper::transaction($model->transaction)
	    		],
	    		'paid_amount:currency',
	    		'created_at:date',
	    		'updated_at:date',
	    	]
	])?>
</div>
<?php Pjax::end(); ?>
