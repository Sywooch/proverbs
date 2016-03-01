<?php

use yii\helpers\Html;
use kartik\select2\Select2;
use app\models\ActiveRecord;
use app\models\EnrolledForm;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
?>

<div class="nursery-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="container form-input-wrapper">
            <div class="col-lg-4 col-md-4 col-sm-12">
                <?= $model->isNewRecord ?
                    $form->field($model, 'enrolled_id')->widget(Select2::classname(), [
                        'data' => ArrayHelper::map(EnrolledForm::find()->all(),'id', function($model){return $model->id . ' ' . $model->student->id . ' ' . $model->student->last_name . ', ' . $model->student->first_name . ' ' . $model->student->middle_name;}),
                        'language' => 'en',
                        'options' => ['id' => 'auto-suggest','placeholder' => 'Enter ID #'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ])->label(false) 
                    : $model->enrolled->student->id . ' ' . $model->enrolled->student->last_name . ', ' . $model->enrolled->student->first_name . ' ' . $model->enrolled->student->middle_name;
                ?>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12">
                <?= $form->field($model, 'grade_protection', ['inputTemplate' => '<div class="input-group"><span class="input-group-addon"><span class="dropdown-list">Protection</span></span></span>{input}</div>'])->dropDownList(['0' => 'Off', '1' => 'On'], ['default' => 'Off'])->label(false) ?>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <?= $form->field($model, 'grading_period', ['inputTemplate' => '<div class="input-group"><span class="input-group-addon subject-min-width"><span class="dropdown-list">Grading Period</span></span></span>{input}</div>'])->dropDownList(['1' => '1st Grading', '2' => '2nd Grading', '3' => '3rd Grading', '4' => '4th Grading'], ['default' => '1st Grading'])->label(false) ?>
            </div>  
        </div>
    </div>             
    <div class="row">
        <div class="container form-input-wrapper">
            <div class="col-lg-3 col-md-3 col-sm-12">
                <?= $form->field($model, 'subject_1', ['inputTemplate' => '<div class="input-group"><span class="input-group-addon subject-min-width">Reading</span></span>{input}</div>'])->textInput()->label(false) ?>
                <?= $form->field($model, 'subject_2', ['inputTemplate' => '<div class="input-group"><span class="input-group-addon subject-min-width">Math</span></span>{input}</div>'])->textInput()->label(false) ?>
                <?= $form->field($model, 'subject_3', ['inputTemplate' => '<div class="input-group"><span class="input-group-addon subject-min-width">English</span></span>{input}</div>'])->textInput()->label(false) ?>
                <?= $form->field($model, 'subject_4', ['inputTemplate' => '<div class="input-group"><span class="input-group-addon subject-min-width">Science</span></span>{input}</div>'])->textInput()->label(false) ?>
                <?= $form->field($model, 'subject_5', ['inputTemplate' => '<div class="input-group"><span class="input-group-addon subject-min-width">Writing</span></span>{input}</div>'])->textInput()->label(false) ?>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <?= $form->field($model, 'core_value_1', ['inputTemplate' => '<div class="input-group"><span class="input-group-addon values-min-width"><span class="dropdown-list">Maka Diyos</span></span>{input}</div>'])->dropDownList(['1' => 'AO', '2' => 'SO', '3' => 'RO', '4' => 'NO'], ['default' => 'AO'])->label(false) ?>
                <?= $form->field($model, 'core_value_2', ['inputTemplate' => '<div class="input-group"><span class="input-group-addon values-min-width"><span class="dropdown-list">Makatao</span></span>{input}</div>'])->dropDownList(['1' => 'AO', '2' => 'SO', '3' => 'RO', '4' => 'NO'], ['default' => 'AO'])->label(false) ?>
                <?= $form->field($model, 'core_value_3', ['inputTemplate' => '<div class="input-group"><span class="input-group-addon values-min-width"><span class="dropdown-list">Makakalikasan</span></span>{input}</div>'])->dropDownList(['1' => 'AO', '2' => 'SO', '3' => 'RO', '4' => 'NO'], ['default' => 'AO'])->label(false) ?>
                <?= $form->field($model, 'core_value_4', ['inputTemplate' => '<div class="input-group"><span class="input-group-addon values-min-width"><span class="dropdown-list">Makabansa</span></span>{input}</div>'])->dropDownList(['1' => 'AO', '2' => 'SO', '3' => 'RO', '4' => 'NO'], ['default' => 'AO'])->label(false) ?>
            </div>
        </div>                
    </div> 
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Cancel'), ['/nursery'], ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
