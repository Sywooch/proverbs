<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AssessmentForm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="assessment-form-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'enrolled_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tuition_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
