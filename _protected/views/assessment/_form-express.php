<?php

use yii\web\View;
use yii\widgets\DetailView;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Dropdown;
use app\models\Tuition;
use app\models\GradeLevel;
use app\models\SiblingDiscount;

$sbm = new SiblingDiscount;
$sbd = SiblingDiscount::find()->all();

if(!empty($array)) {
    $enrollment_float   = $array[0]['enrollment'];
    $admission_float    = $array[0]['admission'];
    $tuition_fee_float  = $array[0]['tuition_fee'];
    $misc_fee_float     = $array[0]['misc_fee'];
    $ancillary_float    = $array[0]['ancillary'];
    $monthly_float      = $array[0]['monthly'];
    $yearly_float       = $array[0]['yearly'];
    $books_float        = $array[0]['books'];

	$grade_level 	= GradeLevel::findOne($array[0]['grade_level_id'])['name'];
	$enrollment 	= number_format($array[0]['enrollment'], 2);
	$admission 		= number_format($array[0]['admission'], 2);
	$tuition_fee 	= number_format($array[0]['tuition_fee'], 2);
	$misc_fee 		= number_format($array[0]['misc_fee'], 2);
	$ancillary 		= number_format($array[0]['ancillary'], 2);
	$monthly 		= number_format($array[0]['monthly'], 2);
	$yearly 		= number_format($array[0]['yearly'], 2);
	$books 			= number_format($array[0]['books'], 2);
} else {
	$grade_level 	= 0;
	$enrollment 	= 0;
	$admission 		= 0;
	$tuition_fee 	= 0;
	$misc_fee 		= 0;
	$ancillary 		= 0;
	$monthly 		= 0;
	$yearly 		= 0;
	$books 			= 0;
}
?>
<div class="assessment-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'tuition_id', ['inputTemplate' => '{input}', 'inputOptions' => ['class' => 'hidden']])->label(false) ?>
	<div class="row">
		<div class="col-lg-3 col-md-3 col-sm-12">
			<table class="table table-striped table-bordered detail-view">
				<tbody>
				<tr>
					<td>
						<p>
							<div id="sibling"><?= $form->field($model, 'has_sibling_discount', ['inputTemplate' => '<div style="margin-top: 2px;"><label style="padding: 0; color: #555;"><strong>Sibling Discount</strong></label><div class="pull-right">{input}</div></div>', 'inputOptions' => ['style' => 'color: black;']])->checkbox($options = ['class' => 'js-switch', 'data-switchery' => true ])->label(false) ?></div>
							<div id="select-discount">
							<?= Html::activeDropDownList($sbm, 'id', 
								ArrayHelper::map(SiblingDiscount::find()->asArray()->all(), 'id' , 'percentage_value'), 
								['class'=>'form-control', 'name' => 'sibling_discount']) ?>
					    	</div>
						</p>
					</td>
				</tr>
				<tr>
					<td>
						<p>
							<div id="book"><?= $form->field($model, 'has_book_discount', ['inputTemplate' => '<div style="margin-top: 2px;"><label style="padding: 0; color: #555;"><strong>Book Discount</strong></label><div class="pull-right">{input}</div></div>', 'inputOptions' => ['style' => 'color: black;']])->checkbox($options = ['class' => 'js-switch', 'data-switchery' => true])->label(false) ?></div>
						</p>
					</td>
				</tr>
				<tr>
					<td>
						<p>
							<div id="honor">
								<?= $form->field($model, 'has_honor_discount', ['inputTemplate' => '<div style="margin-top: 2px;"><label style="padding: 0; color: #555;"><strong>Honor Discount</strong></label><div class="pull-right">{input}</div></div>', 'inputOptions' => ['style' => 'color: black;']])->checkbox($options = ['class' => 'js-switch', 'data-switchery' => true])->label(false) ?>
							</div>
						</p>
					</td>
				</tr>
				</tbody>
			</table>
			<p></p>
			<table class="table table-striped table-bordered">
				<tbody>
					<th id="th-balance"><span>BALANCE</span></th>
					<tr>
						<td><?= $form->field($model, 'balance', ['inputTemplate' => '{input}', 'inputOptions' => ['class' => 'form-control text-align-right' , 'style' => 'color : #555; font-weight: 800; font-size: 16px;', 'value' => number_format(0, 2)] ])->label(false) ?></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	<p></p>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    <?php ActiveForm::end(); ?>
    </div>
</div>
<?php
$tif = json_encode($tuition_fee_float);
$tff = json_encode($tuition_fee_float);
$yra = json_encode($yearly_float);
$bkt = json_encode($books_float);
$tdf = json_encode(0);
$ttl = json_encode(0);
$bal = json_encode(0);

$this->render('switch');
?>