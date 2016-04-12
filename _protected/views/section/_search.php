<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model app\models\SectionSearch */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="section-search">
    <h4>Search</h4>
    <hr class="hr-full-width">
    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
    <?= $form->field($model, 'section_name') ?>
    <?= $form->field($model, 'grade_level_id', ['inputTemplate' => '<div class="input-div-wrap"><label>Grade Level</label>{input}</div>','inputOptions' => ['class' => 'form-control pva-form-control']])->dropDownList($model->gradeList)->label(false) ?>
    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary btn-block']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default btn-block']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
