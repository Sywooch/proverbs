<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\GradeTwelveFirstSemFormSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="grade-twelve-first-sem-form-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'grade_protection') ?>

    <?= $form->field($model, 'enrolled_id') ?>

    <?= $form->field($model, 'grading_period') ?>

    <?= $form->field($model, 'core_value_1') ?>

    <?php // echo $form->field($model, 'core_value_2') ?>

    <?php // echo $form->field($model, 'core_value_3') ?>

    <?php // echo $form->field($model, 'core_value_4') ?>

    <?php // echo $form->field($model, 'subject_1') ?>

    <?php // echo $form->field($model, 'subject_2') ?>

    <?php // echo $form->field($model, 'subject_3') ?>

    <?php // echo $form->field($model, 'subject_4') ?>

    <?php // echo $form->field($model, 'subject_5') ?>

    <?php // echo $form->field($model, 'subject_6') ?>

    <?php // echo $form->field($model, 'subject_7') ?>

    <?php // echo $form->field($model, 'subject_8') ?>

    <?php // echo $form->field($model, 'subject_9') ?>

    <?php // echo $form->field($model, 'subject_10') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
