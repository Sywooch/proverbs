<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
?>

<?php $form = ActiveForm::begin(['action' => ['index'],'method' => 'get',]); ?>
<div class="ui fluid vertical menu">
    <div class="item">
        <?= Html::a('More', '#user-filters-more' , ['class' => 'ui right floated small basic button collapsed', 'role' => 'button', 'data-toggle' => 'collapse', 'aria-expanded' => 'false', 'aria-controls' => 'user-filters-more', 'aria-expanded' => 'false'])?>
        <div class="header"><span><i class="ui massive icon search"></i></span></div>
    </div>
    <div class="item">
        <p></p>
        <?= Html::submitButton('Search', ['id' => 'search', 'class' => 'ui fluid huge primary button']) ?>
        <p></p>
        <?= Html::button('Reset', ['id' => 'clear', 'class' => 'ui fluid huge basic button']) ?>
        <p></p>
        <?= $form->field($model, 'username', ['inputTemplate' => '<label for="Username">Username</label>{input}', 'inputOptions' => ['class' => 'form-control pva-form-control'] ])->label(false) ?>
        <?= $form->field($model, 'email', ['inputTemplate' => '<label for="Email">Email</label>{input}', 'inputOptions' => ['class' => 'form-control pva-form-control'] ])->label(false) ?>
        <?= $form->field($model, 'item_name', ['inputTemplate' => '<label for="Role">Role</label>{input}'])->dropDownList($model->rolesArray, ['class' => 'form-control pva-form-control'])->label(false) ?>
        <?= $form->field($model, 'status', ['inputTemplate' => '<label for="Status">Status</label>{input}'])->dropDownList($model->statusArray, ['class' => 'form-control pva-form-control'])->label(false) ?>
    </div>
    <div class="item">
        <div class="collapse" id="user-filters-more">
            <p></p>
            <?= $form->field($model, 'id', ['inputTemplate' => '<label for="User ID">ID</label>{input}', 'inputOptions' => ['class' => 'form-control pva-form-control'] ])->label(false) ?>
            <?= $form->field($model, 'first_name', ['inputTemplate' => '<label for="First Name">First Name</label>{input}', 'inputOptions' => ['class' => 'form-control pva-form-control'] ])->label(false) ?>
            <?= $form->field($model, 'middle_name', ['inputTemplate' => '<label for="Middle Name">Middle Name</label>{input}', 'inputOptions' => ['class' => 'form-control pva-form-control'] ])->label(false) ?>
            <?= $form->field($model, 'last_name', ['inputTemplate' => '<label for="Last Name">Last Name</label>{input}', 'inputOptions' => ['class' => 'form-control pva-form-control'] ])->label(false) ?>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>
<?php
$clear = <<< JS
$(document).ready(function(){
    var clr = $('#clear')
    clr.click(function(){
        $("#usersearch-item_name").val($("#usersearch-item_name option:first").val());
        $("#usersearch-status").val($("#usersearch-status option:first").val());
        $('input[type=\"text\"]').val('');
    });
});
JS;
$this->registerJs($clear);
?>