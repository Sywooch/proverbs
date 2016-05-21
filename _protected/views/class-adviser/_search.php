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
        <?= $form->field($model, 'id', ['inputTemplate' => '<label for="ID">ID</label>{input}', 'inputOptions' => ['class' => 'form-control pva-form-control'] ])->label(false) ?>
        <?= $form->field($model, 'sy_id', ['inputTemplate' => '<label for="School Year">School Year</label>{input}', 'inputOptions' => ['class' => 'form-control pva-form-control'] ])->label(false) ?>
        <?= $form->field($model, 'teacher_id', ['inputTemplate' => '<label for="Teacher">Teacher</label>{input}', 'inputOptions' => ['class' => 'form-control pva-form-control'] ])->label(false) ?>
        <?= $form->field($model, 'section_id', ['inputTemplate' => '<label for="Section">Section</label>{input}'])->label(false) ?>
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
        $("#assignedformsearch-id").val($("#assignedformsearch-grade_level_id option:first").val());
        $("#assignedformsearch-sy_id").val($("#assignedformsearch-enrollment_status option:first").val());
        $("#assignedformsearch-teacher_id").val($("#assignedformsearch-enrollment_status option:first").val());
        $("#assignedformsearch-section_id").val($("#assignedformsearch-enrollment_status option:first").val());
        $('input[type=\"text\"]').val('');
    });
});
JS;
$this->registerJs($clear);
?>