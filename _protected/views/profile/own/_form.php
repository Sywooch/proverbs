<?php

use yii\helpers\Html;
use yii\jui\DatePicker;
use nesbot\Carbon;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
//use kartik\field\FieldRange;
//use kartik\widgets\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\ProfileForm */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="profile-form-form">
    
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'middle_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gender', ['inputTemplate' => '<div class="input-group"><span class="input-group-addon"><span class="dropdown-list">Gender</span></span></span>{input}</div>'])->dropDownList(['0' => 'Male', '1' => 'Female'], ['default' => 'Male'])->label(false) ?>
    
    <?= $form->field($model, 'birth_date')->widget(DatePicker::className(),['options' => ['class' => ['form-control']] ] )?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput() ?>

    <?= $form->field($model, 'mobile')->textInput() ?>

    <div class="form-group">
        <?= Html::a(Yii::t('app', 'Back'), ['index'], ['class' => 'btn btn-warning']) ?>
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Save', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script>
$('.datepicker').datepicker();
</script>