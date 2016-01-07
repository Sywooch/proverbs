<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EntranceExamFormSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="entrance-exam-form-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'applicant_id') ?>

    <?= $form->field($model, 'interviewer') ?>

    <?= $form->field($model, 'english') ?>

    <?= $form->field($model, 'reading_skills') ?>

    <?php // echo $form->field($model, 'science') ?>

    <?php // echo $form->field($model, 'comprehension') ?>

    <?php // echo $form->field($model, 'remarks') ?>

    <?php // echo $form->field($model, 'recommendations') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
