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
            [
            	'attribute' => 'percentage_value',
            	'value' => $model->percentage_value . '%'
            ],
            'sibling_discount:currency',
            'book_discount:currency',
            'honor_discount:currency',
            'total_assessed:currency',
            'balance:currency',
            'created_at:date',
            'updated_at:date',
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
<div class="ui tab segment" data-tab="third" style="min-height: 80px;">
	<div class="ui inverted dimmer">
	    <div class="ui massive text loader"></div>
	</div>
	<?= Html::a('New Payment',['/payments/new', 'sid' => $model->enrolled->student->id, 'aid' =>$model->id],['class' => 'ui right floated big basic button'])?>
	<?php
		if(count($payments) > 0){
			for ($i=0; $i < count($payments); $i++) {
				echo implode('',[
					'<div class="ui two stackable grid">',
						'<div class="eight wide column">',
							'<label><strong>',
								DataHelper::carbonDate($payments[$i]->created_at),
							'</strong></label>',
						'</div>',
						'<div class="eight wide column">',
							UiTable::widget([
							    'model' => $payments[$i],
							    'options' => ['class' => 'ui fixed basic payment-history table'],
							    'attributes' => [
							    	[
							    		'attribute' => 'payment_description',
							    		'value' => DataHelper::paymentDescription($payments[$i]->payment_description)
							    	],
							    	[
							    		'attribute' => 'transaction',
							    		'value' => DataHelper::transaction($payments[$i]->transaction)
							    	],
							    	'paid_amount:currency',
							    ],
						    ]),
						'</div>',
					'</div>',
					'<div class="ui divider"></div>'
				]);
			}
		}else {
			echo 'No payment transactions yet.';
		}
	?>

</div>
<?php Pjax::end(); ?>
