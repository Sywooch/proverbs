<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use nesbot\Carbon;
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

    <?= $form->field($model, 'gender')->radioList(
                            ['Male' => 'Male', 'Female' => 'Female'],['separator' => '&nbsp;&nbsp;'],
                            [
                                'item' => function($index, $label, $name, $checked, $value) {

                                    $return = '<label class="modal-radio">';
                                    $return .= '<input type="radio" name="' . $name . '" value="' . $value . '" tabindex="3">';
                                    $return .= '<i></i>';
                                    $return .= '<span>' . ucwords($label) . '</span>';
                                    $return .= '</label>';

                                    return $return;
                                }
                            ]
                        ) ?>
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