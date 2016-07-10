<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
?>
<?php $form = ActiveForm::begin(['action' => ['index'],'method' => 'get',]); ?>
<div class="ui fluid vertical menu">
    <div class="item">
        <?= Html::a('More', '#student-filters-more' , ['class' => 'ui right floated small basic button collapsed', 'role' => 'button', 'data-toggle' => 'collapse', 'aria-expanded' => 'false', 'aria-controls' => 'student-filters-more', 'aria-expanded' => 'false'])?>
        <div class="header"><span><i class="ui massive icon search"></i></span></div>
    </div>
    <div class="item">
        <br>
        <?= Html::submitButton('Search', ['id' => 'search', 'class' => 'ui fluid huge primary button']) ?>
        <br>
        <?= Html::button('Reset', ['id' => 'clear', 'class' => 'ui fluid huge basic button']) ?>
        <br>
        <?= $form->field($model, 'id', ['inputTemplate' => '<label for="ID">ID</label>{input}', 'inputOptions' => ['class' => 'form-control pva-form-control'] ])->label(false) ?>
        <?= $form->field($model, 'request_text', ['inputTemplate' => '<label for="Request Details">Request Details</label>{input}', 'inputOptions' => ['class' => 'form-control pva-form-control'] ])->label(false) ?>
        <?= $form->field($model, 'request_status', ['inputTemplate' => '<label>Request Status</label>{input}', 'inputOptions' => ['class' => 'form-control pva-form-control'] ])->dropDownList(['' => '', '1' => 'Processing', '2' => 'Approved', '3' => 'Denied', '4' => 'Deleted'], ['selected' => $model->request_status])->label(false) ?>
    </div>
</div>
<?php ActiveForm::end(); ?>
<?php
$clear = <<< JS
$(document).ready(function(){
    var clr = $('#clear')
    clr.click(function(){
        $("#requestformsearch-gender").val($("#studentformsearch-gender option:first").val());
        //$("#studentformsearch-grade_level_id").val($("#studentformsearch-grade_level_id option:first").val());
        $('input[type=\"text\"]').val('');
    });
});
JS;
$this->registerJs($clear);
?>
