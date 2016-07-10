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
        <p></p>
        <?= Html::submitButton('Search', ['id' => 'search', 'class' => 'ui fluid huge primary button']) ?>
        <p></p>
        <?= Html::button('Reset', ['id' => 'clear', 'class' => 'ui fluid huge basic button']) ?>
        <p></p>
        <?= $form->field($model, 'id', ['inputTemplate' => '<label for="ID">ID#</label>{input}', 'inputOptions' => ['class' => 'form-control pva-form-control'] ])->label(false) ?>
        <?= $form->field($model, 'first_name', ['inputTemplate' => '<label for="First Name">First Name</label>{input}', 'inputOptions' => ['class' => 'form-control pva-form-control'] ])->label(false) ?>
        <?= $form->field($model, 'middle_name', ['inputTemplate' => '<label for="Middle Name">Middle Name</label>{input}', 'inputOptions' => ['class' => 'form-control pva-form-control'] ])->label(false) ?>
        <?= $form->field($model, 'last_name', ['inputTemplate' => '<label for="Last Name">Last Name</label>{input}', 'inputOptions' => ['class' => 'form-control pva-form-control'] ])->label(false) ?>
    </div>
    <div class="item">
        <div class="collapse" id="student-filters-more">
            <br>
            <?= $form->field($model, 'nickname', ['inputTemplate' => '<label for="Nickname">Nickname</label>{input}', 'inputOptions' => ['class' => 'form-control pva-form-control'] ])->label(false) ?>
            <?= $form->field($model, 'gender', ['inputTemplate' => '<label for="Gender">Gender</label>{input}'])->dropDownList($model->genderList, ['class' => 'form-control pva-form-control'])->label(false) ?>
            <?= $form->field($model, 'grade_level_id', ['inputTemplate' => '<label for="Grade Level">Grade Level</label>{input}'])->dropDownList($model->levelList, ['class' => 'form-control pva-form-control'])->label(false) ?>
            <?= $form->field($model, 'religion', ['inputTemplate' => '<label for="Religion">Religion</label>{input}', 'inputOptions' => ['class' => 'form-control pva-form-control'] ])->label(false) ?>
            <?= $form->field($model, 'citizenship', ['inputTemplate' => '<label for="Citizenship">Citizenship</label>{input}', 'inputOptions' => ['class' => 'form-control pva-form-control'] ])->label(false) ?>
            <?= $form->field($model, 'address', ['inputTemplate' => '<label for="Address">Address</label>{input}', 'inputOptions' => ['class' => 'form-control pva-form-control'] ])->label(false) ?>
            <?= $form->field($model, 'zip_code', ['inputTemplate' => '<label for="Zip Code">Zip Code</label>{input}', 'inputOptions' => ['class' => 'form-control pva-form-control'] ])->label(false) ?>
            <?= $form->field($model, 'mobile', ['inputTemplate' => '<label for="Mobile">Mobile</label>{input}', 'inputOptions' => ['class' => 'form-control pva-form-control'] ])->label(false) ?>
            <?= $form->field($model, 'phone', ['inputTemplate' => '<label for="Phone">Phone</label>{input}', 'inputOptions' => ['class' => 'form-control pva-form-control'] ])->label(false) ?>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>
<?php
$clear = <<< JS
$(document).ready(function(){
    var clr = $('#clear')
    clr.click(function(){
        $("#studentformsearch-gender").val($("#studentformsearch-gender option:first").val());
        $("#studentformsearch-grade_level_id").val($("#studentformsearch-grade_level_id option:first").val());
        $('input[type=\"text\"]').val('');
    });
});
JS;
$this->registerJs($clear);
?>
