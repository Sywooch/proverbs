<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EnrolledFormSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="enrolled-form-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php // echo $form->field($model, 'id') ?>

    <?= $form->field($model, 'student_id') ?>

    <?php // echo $form->field($model, 'grade_level_id') ?>

    <?php // echo $form->field($model, 'enrollment_status') ?>

    <?php // echo $form->field($model, 'from_school_year') ?>

    <?php // echo $form->field($model, 'to_school_year') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
