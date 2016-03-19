<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Tuition */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tuition-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'grade_level_id')->textInput() ?>

    <?= $form->field($model, 'enrollment')->textInput() ?>

    <?= $form->field($model, 'admission')->textInput() ?>

    <?= $form->field($model, 'tuition_fee')->textInput() ?>

    <?= $form->field($model, 'misc_fee')->textInput() ?>

    <?= $form->field($model, 'ancillary')->textInput() ?>

    <?= $form->field($model, 'yearly')->textInput() ?>

    <?= $form->field($model, 'monthly')->textInput() ?>

    <?= $form->field($model, 'books')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
