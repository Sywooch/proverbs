<?php
use app\models\DataHelper;
use yii\helpers\ArrayHelpers;
use yii\helpers\Html;
use app\models\UiTable;
use app\models\Tuition;
use yii\widgets\Pjax;

$tuition = Tuition::findOne($model->tuition_id);
$avatar = Yii::$app->request->baseUrl . Yii::$app->params['avatar'];
!empty($model->enrolled->student->students_profile_image) ? $img = Yii::$app->request->baseUrl . '/uploads/students/' . $model->enrolled->student->students_profile_image : $img = $avatar;
?>
<?php Pjax::begin(['id' => 'assessment-detail', 'timeout' => 60000]); ?>
<div class="ui tab segment active" data-tab="first">
	<div class="ui inverted dimmer">
	    <div class="ui massive text loader"></div>
	</div>
	<?= UiTable::widget([
	    'model' => $model,
	    'options' => ['class' => 'ui fixed very basic table'],
	    'attributes' => [
	    	'enrolled_id',
            [
            	'attribute' => 'has_sibling_discount',
            	'value' => DataHelper::direct($model->has_sibling_discount)
            ],
            [
            	'attribute' => 'has_honor_discount',
            	'value' => DataHelper::direct($model->has_honor_discount)
            ],
            [
            	'attribute' => 'has_book_discount',
            	'value' => DataHelper::direct($model->has_book_discount)
            ],
            'sibling_discount:currency',
            [
            	'attribute' => 'percentage_value',
            	'value' => $model->percentage_value . '%'
            ],
            'book_discount:currency',
            'honor_discount:currency',
            'total_assessed:currency',
            'balance:currency',
            'created_at:date',
            [
            	'attribute' => 'updated_at',
            	'value' => DataHelper::carbonDateDiff($model->updated_at)
            ],
    	]
	])?>
</div>
<div class="ui tab segment" data-tab="second">
	<div class="ui inverted dimmer">
	    <div class="ui massive text loader"></div>
	</div>
	<?= UiTable::widget([
	    'model' => $tuition,
	    'options' => ['class' => 'ui fixed very basic table'],
	    'attributes' => [
	    	'enrollment:currency',
	    	'admission:currency',
	    	'tuition_fee:currency',
	    	'misc_fee:currency',
	    	'ancillary:currency',
	    	'yearly:currency',
	    	'monthly:currency',
	    	'books:currency',
	    ],
    ]) ?>
</div>
<div class="ui tab segment" data-tab="third">
	<div class="ui inverted dimmer">
	    <div class="ui massive text loader"></div>
	</div>
	adf
</div>
<?php Pjax::end(); ?>