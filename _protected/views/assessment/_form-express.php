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
/*$sbd = <<< JS
$(document).ready(function(){
	var tff = $tff; 
	var tdf = $tdf;
	var yra = $yra;
	var bkt = $bkt;
	var ttl = $ttl;
	var bal = $bal;
	var dri = $('#siblingdiscount-id'),
		sdt	 = $('#td-sb-discount-value'),
		tdv	 = $('#td-total-discount-value'),
		yrl	 = $('#td-yearly'),
		bks	 = $('#td-books'),
		sub	 = $('#td-sub'),
		less = $('#td-less'),
		tta	 = $('#assessmentform-total_assessed'),
		sbi = $('#assessmentform-has_sibling_discount'),
		bki = $('#assessmentform-has_book_discount'),
		hri = $('#assessmentform-has_honor_discount'),
		sbv = $('#assessmentform-sibling_discount'),
		bkv = $('#assessmentform-book_discount'),
		hrv = $('#assessmentform-honor_discount'),
		asf	 = $('#assessmentform-balance'),

		hsi = $('input:hidden[name*="AssessmentForm[has_sibling_discount]"]'),
		hbi = $('input:hidden[name*="AssessmentForm[has_book_discount]"]'),
		hhi = $('input:hidden[name*="AssessmentForm[has_honor_discount]"]');

		n();
		i();

		function n(){
			hsi.attr('id', 'h-sbi');
			hbi.attr('id', 'h-bki');
			hhi.attr('id', 'h-hri');
			l();
		}

		//LOAD
		function l(){
			s();
			b();
			h();
		}

		function s(){
			if(parseInt(sbi.val()) === 1) {
				sbi.attr('checked', true);
				$('#h-sbi').val(1);
			} else {
				sbi.removeAttr('checked');
				$('#h-sbi').val(0);
			}
		}

		function b(){
			if(parseInt(bki.val()) === 1) {
				bki.attr('checked', true);
				$('#h-bki').val(1);
			} else {
				bki.removeAttr('checked');
				$('#h-bki').val(0);
			}
		}

		function h(){
			if(parseInt(hri.val()) === 1) {
				hri.attr('checked', true);
				$('#h-hri').val(1);
			} else {
				hri.removeAttr('checked');
				$('#h-hri').val(0);
			}
		}

		dri.change(function(){
			i();
		});

		sbi.change(function(){
			if(parseInt($(this).val()) === 0){
				$(this).val(1);
				$(this).attr('checked', true);
				$('#h-sbi').val(1);
			} else {
				$(this).val(0);
				$(this).removeAttr('checked');
				$('#h-sbi').val(0);
			}
			i();
		});

		bki.change(function(){
			if(parseInt($(this).val()) === 0){
				$(this).val(1);
				$(this).attr('checked', true);
				$('#h-bki').val(1);
			} else {
				$(this).val(0);
				$(this).removeAttr('checked');
				$('#h-bki').val(0);
			}
			i();
		});

		hri.change(function(){
			if(parseInt($(this).val()) === 0){
				$(this).val(1);
				$(this).attr('checked', true);
				$('#h-hri').val(1);
			} else {
				$(this).val(0);
				$(this).removeAttr('checked');
				$('#h-hri').val(0);
			}
			i();
		});
	
	function c(data){
		yrl.html(data.yra);
		bks.html(data.bkt);
		sub.html(data.sub);
		less.html(data.tdf);
		sdt.text(data.sdt);
		sbv.val(data.sbv);
		tdv.html(data.tdf);
		tta.val(data.ttl);
		asf.val(data.bal);
	}

	function i(){
		$.ajax({
			type: "POST",
			url: "calc?data=" + JSON.stringify({
					dri: dri.find(":selected").text(),
					sdt: "0",
					tff: tff,
					tdf: tdf,
					yra: yra,
					bkt: bkt,
					sbi: sbi.val(), bki: bki.val(), hri: hri.val(),
					sbv: sbv.val(), bkv: bkv.val(), hrv: hrv.val(),
					sub: 0,
					ttl: ttl,
					bal: bal
				}),
			contentType: "application/json; charset=utf-8",
			dataType: "json",
			success: function(data) {
				//console.log(data);
				c(data);
			}
		});		
	}
});
JS;
$this->registerJs($sbd);*/
?>