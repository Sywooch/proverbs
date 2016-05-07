<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
?>

<?php $form = ActiveForm::begin(['action' => ['index'],'method' => 'get',]); ?>
<div class="ui fluid vertical menu">
    <div class="item">
        <div class="header"><span><i class="ui massive icon search"></i></span></div>
    </div>
    <div class="item">
        <p></p>
        <?= Html::submitButton('Search', ['id' => 'search', 'class' => 'ui fluid huge primary button']) ?>
        <p></p>
        <?= Html::button('Reset', ['id' => 'clear', 'class' => 'ui fluid huge basic button']) ?>
        <p></p>
        <?= $form->field($model, 'id', ['inputTemplate' => '<label for="Assessment ID">Assessment ID</label>{input}', 'inputOptions' => ['class' => 'form-control pva-form-control'] ])->label(false) ?>
        <?= $form->field($model, 'enrolled_id', ['inputTemplate' => '<label for="Enrolled ID">Enrolled ID</label>{input}', 'inputOptions' => ['class' => 'form-control pva-form-control'] ])->label(false) ?>
        <?php // $form->field($model, 'enrollment_status', ['inputTemplate' => '<label for="Status">Status</label>{input}', 'inputOptions' => ['class' => 'form-control pva-form-control'] ])->dropDownList($model->statusList, ['class' => 'form-control pva-form-control'])->label(false) ?>
        <?php // $form->field($model, 'grade_level_id', ['inputTemplate' => '<label for="Grade Level">Grade Level</label>{input}'])->dropDownList($model->levelList, ['class' => 'form-control pva-form-control'])->label(false) ?>
    </div>
    <div class="item">
    </div>
</div>
<?php ActiveForm::end(); ?>
<?php
$clear = <<< JS
$(document).ready(function(){
    var clr = $('#clear')
    clr.click(function(){
        $("#assessmentformsearch-grade_level_id").val($("#assessmentformsearch-grade_level_id option:first").val());
        $("#assessmentformsearch-enrollment_status").val($("#assessmentformsearch-enrollment_status option:first").val());
        $('input[type=\"text\"]').val('');
    });
});
JS;
$this->registerJs($clear);
?>