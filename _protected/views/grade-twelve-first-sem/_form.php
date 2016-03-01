<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\GradeTwelveFirstSemForm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="grade-twelve-first-sem-form-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'grade_protection')->textInput() ?>

    <?= $form->field($model, 'enrolled_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'grading_period')->textInput() ?>

    <?= $form->field($model, 'core_value_1')->textInput() ?>

    <?= $form->field($model, 'core_value_2')->textInput() ?>

    <?= $form->field($model, 'core_value_3')->textInput() ?>

    <?= $form->field($model, 'core_value_4')->textInput() ?>

    <?= $form->field($model, 'subject_1')->textInput() ?>

    <?= $form->field($model, 'subject_2')->textInput() ?>

    <?= $form->field($model, 'subject_3')->textInput() ?>

    <?= $form->field($model, 'subject_4')->textInput() ?>

    <?= $form->field($model, 'subject_5')->textInput() ?>

    <?= $form->field($model, 'subject_6')->textInput() ?>

    <?= $form->field($model, 'subject_7')->textInput() ?>

    <?= $form->field($model, 'subject_8')->textInput() ?>

    <?= $form->field($model, 'subject_9')->textInput() ?>

    <?= $form->field($model, 'subject_10')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
