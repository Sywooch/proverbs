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
    if($model->isNewRecord){
        $enrollment_float   = $array[0]['enrollment'];
        $admission_float    = $array[0]['admission'];
        $tuition_fee_float  = $array[0]['tuition_fee'];
        $misc_fee_float     = $array[0]['misc_fee'];
        $ancillary_float    = $array[0]['ancillary'];
        $monthly_float      = $array[0]['monthly'];
        $yearly_float       = $array[0]['yearly'];
        $books_float        = $array[0]['books'];

        $grade_level    = GradeLevel::findOne($array[0]['grade_level_id'])['name'];
        $enrollment     = number_format($array[0]['enrollment'], 2);
        $admission      = number_format($array[0]['admission'], 2);
        $tuition_fee    = number_format($array[0]['tuition_fee'], 2);
        $misc_fee       = number_format($array[0]['misc_fee'], 2);
        $ancillary      = number_format($array[0]['ancillary'], 2);
        $monthly        = number_format($array[0]['monthly'], 2);
        $yearly         = number_format($array[0]['yearly'], 2);
        $books          = number_format($array[0]['books'], 2);
    } 
    else {
        $enrollment_float   = $array[0]['enrollment'];
        $admission_float    = $array[0]['admission'];
        $tuition_fee_float  = $array[0]['tuition_fee'];
        $misc_fee_float     = $array[0]['misc_fee'];
        $ancillary_float    = $array[0]['ancillary'];
        $monthly_float      = $array[0]['monthly'];
        $yearly_float       = $array[0]['yearly'];
        $books_float        = $array[0]['books'];

        $grade_level    = GradeLevel::findOne($array[0]['grade_level_id'])['name'];
        $enrollment     = number_format($array[0]['enrollment'], 2);
        $admission      = number_format($array[0]['admission'], 2);
        $tuition_fee    = number_format($array[0]['tuition_fee'], 2);
        $misc_fee       = number_format($array[0]['misc_fee'], 2);
        $ancillary      = number_format($array[0]['ancillary'], 2);
        $monthly        = number_format($array[0]['monthly'], 2);
        $yearly         = number_format($array[0]['yearly'], 2);
        $books          = number_format($array[0]['books'], 2);

    }
} else {
    $grade_level    = 0;
    $enrollment     = 0;
    $admission      = 0;
    $tuition_fee    = 0;
    $misc_fee       = 0;
    $ancillary      = 0;
    $monthly        = 0;
    $yearly         = 0;
    $books          = 0;
}

if($model->isNewRecord){
    if($student->student_has_sibling_enrolled === 0) {
        $sb = 0;
    }else {
        $sb = 1;
    }
}
?>
<div class="assessment-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'tuition_id', ['inputTemplate' => '{input}', 'inputOptions' => ['class' => 'hidden']])->label(false) ?>
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-12">
            <table class="table table-striped table-bordered detail-view">
                <tbody>
                    <tr><th>Grade Level</th><td><span class="pull-right"><?= $grade_level ?></span></td></tr>
                    <tr><th>Enrollment</th><td><span class="pull-right"><?= $enrollment ?></span></td></tr>
                    <tr><th>Admission</th><td><span class="pull-right"><?= $admission ?></span></td></tr>
                    <tr><th>Tuition</th><td><span class="pull-right"><?= $tuition_fee ?></span></td></tr>
                    <tr><th>Miscellaneous</th><td><span class="pull-right"><?= $misc_fee ?></span></td></tr>
                    <tr><th>Ancillary</th><td><span class="pull-right"><?= $ancillary ?></span></td></tr>
                    <tr><th>Yearly</th><td><span class="pull-right"><?= $yearly ?></span></td></tr>
                    <tr><th>Monthly</th><td><span class="pull-right"><?= $monthly ?></span></td></tr>
                    <tr><th>Books</th><td><span class="pull-right"><?= $books ?></span></td></tr>
                </tbody>
            </table>
        </div>
        <div class="col-lg-5 col-md-5 col-sm-12">
            <table class="table table-striped table-bordered detail-view">
                <tbody>
                    <tr><td style="width: 180px;"><label>Sibling Discount</label>
                        <p><small id="td-sb-discount-value"></small></p>
                        <p><small id="td-sibling-discount-value"></small></p>
                        </td>
                        <td><?= $model->isNewRecord ?
                            $form->field($model, 'sibling_discount')->textInput(['class' => 'form-control text-align-right', 'value' => $sb === 0 ? $sb : 1])->label(false)
                            :
                            $form->field($model, 'sibling_discount')->textInput(['class' => 'form-control text-align-right'])->label(false)
                        ?>
                        </td>
                    </tr>
                    <tr>
                        <td><label>Book Discount</label><p><small id="td-book-discount-value"></small></p></td>
                        <td><?= $model->isNewRecord ?
                                $form->field($model, 'book_discount')->textInput(['class' => 'form-control text-align-right', 'value' => 0])->label(false)
                                :
                                $form->field($model, 'book_discount')->textInput(['class' => 'form-control text-align-right'])->label(false) 
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td><label>Honor Discount</label><p><small id="td-honor-discount-value"></small></p></td>
                        <td><?= $model->isNewRecord ?
                                $form->field($model, 'honor_discount')->textInput(['class' => 'form-control text-align-right', 'value' => 0])->label(false)
                                :
                                $form->field($model, 'honor_discount')->textInput(['class' => 'form-control text-align-right'])->label(false)
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><span><span class="pull-left"><strong>Total Discount</strong></span><strong><span id="td-total-discount-value" class="pull-right">0</span></strong></span></td>
                    </tr>
                    <tr style="text-align: right;">
                        <td id="td-block" colspan="2">
                            <span id="td-yearly">0</span>
                            <span><span class="pull-left"><strong>+</strong></span><span id="td-books">0</span></span>
                            <span><span class="pull-left"><strong>Sub Total</strong></span><strong><span id="td-sub">0</span></strong></span>
                            <span><span class="pull-left"><strong>Less</strong></span><strong><span id="td-less">0</span></strong></span>
                        </td>
                    </tr>
                    <tr style="text-align: right;">
                        <td><span><span class="pull-left"><strong>TOTAL ASSESSED</strong></span></span></td>
                        <td><?= $form->field($model, 'total_assessed')->textInput(['class' => 'form-control text-align-right' , 'style' => 'font-weight: 800; font-size: 16px;', 'value' => 0])->label(false) ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-12">
            <table class="table table-striped table-bordered detail-view">
                <tbody>
                <tr>
                    <td>
                        <p>
                            <div id="sibling">
                                <?= 
                                    $model->isNewRecord ?                               
                                        $sb === 1 ? 
                                            $form->field($model, 'has_sibling_discount', ['inputTemplate' => '<label style="color: #333;">Sibling Discount</label>&nbsp;&nbsp;{input}', 'inputOptions' => ['style' => 'color: black;']])->checkbox($options = ['value' => $sb ])->label(false) 
                                            :
                                            $form->field($model, 'has_sibling_discount', ['inputTemplate' => '<label style="color: #333;">Sibling Discount</label>&nbsp;&nbsp;{input}', 'inputOptions' => ['style' => 'color: black;']])->checkbox($options = ['value' => $sb])->label(false)
                                        :
                                        $form->field($model, 'has_sibling_discount', ['inputTemplate' => '<label style="color: #333;">Sibling Discount</label>&nbsp;&nbsp;{input}', 'inputOptions' => ['style' => 'color: black;']])->checkbox()->label(false)
                                ?>
                            </div>
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
                            <div id="book">
                                <?= $model->isNewRecord ?
                                    $form->field($model, 'has_book_discount', ['inputTemplate' => '<label style="color: #333;">Book Discount</label>&nbsp;&nbsp;{input}', 'inputOptions' => ['style' => 'color: black;']])->checkbox($options = ['value' => 0])->label(false)
                                    :
                                    $form->field($model, 'has_book_discount', ['inputTemplate' => '<label style="color: #333;">Book Discount</label>&nbsp;&nbsp;{input}', 'inputOptions' => ['style' => 'color: black;']])->checkbox()->label(false)
                                ?>
                            </div>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>
                            <div id="honor">
                                <?= $model->isNewRecord ?
                                    $form->field($model, 'has_honor_discount', ['inputTemplate' => '<label style="color: #333;">Honor Discount</label>&nbsp;&nbsp;{input}', 'inputOptions' => ['style' => 'color: black;']])->checkbox($options = ['value' => 0])->label(false)
                                    :
                                    $form->field($model, 'has_honor_discount', ['inputTemplate' => '<label style="color: #333;">Honor Discount</label>&nbsp;&nbsp;{input}', 'inputOptions' => ['style' => 'color: black;']])->checkbox()->label(false)
                                ?>
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
if($model->isNewRecord){
    $tif = json_encode($tuition_fee_float);
    $tff = json_encode($tuition_fee_float);
    $yra = json_encode($yearly_float);
    $bkt = json_encode($books_float);
} else {
    $tif = json_encode($model->total_assessed);
    $yra = json_encode($tuition[0]['yearly']);
    $bkt = json_encode($tuition[0]['books']);
    $tff = json_encode($tuition[0]['tuition_fee']);
}

$tdf = json_encode(0);
$ttl = json_encode(0);
$bal = json_encode(0);

if($model->isNewRecord){
$sbd = <<< JS
$(document).ready(function(){
    var tff = $tff; 
    var tdf = $tdf;
    var yra = $yra;
    var bkt = $bkt;
    var ttl = $ttl;
    var bal = $bal;
    var dri = $('#siblingdiscount-id'),
        sdt  = $('#td-sb-discount-value'),
        tdv  = $('#td-total-discount-value'),
        yrl  = $('#td-yearly'),
        bks  = $('#td-books'),
        sub  = $('#td-sub'),
        less = $('#td-less'),
        tta  = $('#assessmentform-total_assessed'),
        sbi = $('#assessmentform-has_sibling_discount'),
        bki = $('#assessmentform-has_book_discount'),
        hri = $('#assessmentform-has_honor_discount'),
        sbv = $('#assessmentform-sibling_discount'),
        bkv = $('#assessmentform-book_discount'),
        hrv = $('#assessmentform-honor_discount'),
        asf  = $('#assessmentform-balance'),

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
                console.log(data);
                c(data);
            }
        });     
    }
});
JS;
$this->registerJs($sbd);
} else {
$sbd = <<< JS
$(document).ready(function(){
    var tff = $tff; 
    var tdf = $tdf;
    var yra = $yra;
    var bkt = $bkt;
    var ttl = $ttl;
    var bal = $bal;
    var dri = $('#siblingdiscount-id'),
        sdt  = $('#td-sb-discount-value'),
        tdv  = $('#td-total-discount-value'),
        yrl  = $('#td-yearly'),
        bks  = $('#td-books'),
        sub  = $('#td-sub'),
        less = $('#td-less'),
        tta  = $('#assessmentform-total_assessed'),
        sbi = $('#assessmentform-has_sibling_discount'),
        bki = $('#assessmentform-has_book_discount'),
        hri = $('#assessmentform-has_honor_discount'),
        sbv = $('#assessmentform-sibling_discount'),
        bkv = $('#assessmentform-book_discount'),
        hrv = $('#assessmentform-honor_discount'),
        asf  = $('#assessmentform-balance'),

        hsi = $('input:hidden[name*="AssessmentForm[has_sibling_discount]"]'),
        hbi = $('input:hidden[name*="AssessmentForm[has_book_discount]"]'),
        hhi = $('input:hidden[name*="AssessmentForm[has_honor_discount]"]');
    
        var sbv_init = parseFloat(sbv.val());
        var bkv_init = parseFloat(bkv.val());
        var hrv_init = parseFloat(hrv.val());

        n();
        i();
        u();
        f();
        
        function u(){
            $('#td-sibling-discount-value').html('Loaded Value: ' + sbv_init);
            $('#td-book-discount-value').html('Loaded Value: ' + bkv_init);
            $('#td-honor-discount-value').html('Loaded Value: ' + hrv_init);
        }

        function f(){
            bki.change(function(){
                if(parseInt($(this).val()) === 0){
                    bkv.val(bkv.val());
                    //bkv.val(bkv_init);
                } else {
                    bkv.val(0);
                }
            });

            hri.change(function(){
                if(parseInt($(this).val()) === 0){
                    hrv.val(hrv.val());
                    //hrv.val(hrv_init);
                } else {
                    hrv.val(0);
                }
            });
        }

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
                console.log(data);
                c(data);
            }
        });     
    }
});
JS;
$this->registerJs($sbd);    
}
?>