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
        <?= $form->field($model, 'applicant_id', ['inputTemplate' => '<label for="Applicant ID">Applicant ID</label>{input}', 'inputOptions' => ['class' => 'form-control pva-form-control'] ])->label(false) ?>
        <?= $form->field($model, 'remarks', ['inputTemplate' => '<label for="Remarks">Remarks</label>{input}', 'inputOptions' => ['class' => 'form-control pva-form-control'] ])->label(false) ?>
        <?= $form->field($model, 'recommendations', ['inputTemplate' => '<label for="Recommendations">Recommendations</label>{input}', 'inputOptions' => ['class' => 'form-control pva-form-control'] ])->label(false) ?>
    </div>
    <div class="item">
        <div class="collapse" id="entrance-exam-filters-more">
            <p></p>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>
<?php
$clear = <<< JS
$(document).ready(function(){
    var clr = $('#clear')
    clr.click(function(){
        $('input[type=\"text\"]').val('');
    });
});
JS;
$this->registerJs($clear);
?>