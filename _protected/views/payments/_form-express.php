<?php
use yii\helpers\Html;
use kartik\select2\Select2;
use app\models\ApplicantForm;
use app\models\ActiveRecord;
use app\models\StudentForm;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
?>

<div class="payment-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="container form-input-wrapper">
            <div class="col-lg-4 col-md-4 col-sm-12">
                
            </div>
        </div>
    </div>
    <div class="row">
        <div class="container form-input-wrapper">
            <div class="col-lg-3 col-md-3 col-sm-12"><?= $form->field($model, 'paid_amount',  ['inputTemplate' => '<div class="input-group"><span class="input-group-addon"><span class="">Amount</span></span></span>{input}</div>', 'inputOptions' => ['placeholder' => '0']])->label(false)->textInput() ?></div>
            <div class="col-lg-3 col-md-3 col-sm-12"><?= $form->field($model, 'transaction', ['inputTemplate' => '<div class="input-group"><span class="input-group-addon"><span class="dropdown-list">Transaction</span></span></span>{input}</div>'])->dropDownList(['0' => 'Cash', '1' => 'Card'], ['default' => 'Cash'])->label(false) ?></div>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Cancel'), ['/payments'], ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
