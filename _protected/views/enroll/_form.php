<?php

use yii\helpers\Html;
use kartik\select2\Select2;
use app\models\ApplicantForm;
use app\models\ActiveRecord;
use app\models\StudentForm;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use app\models\GradeLevel;

$current_date = date('Y');
$grade_level = GradeLevel::find()->all();
$listData = ArrayHelper::map($grade_level, 'id' , 'name');
?>

<div class="enrollment-form">
        <?php $form = ActiveForm::begin(); ?>
        <div class="row">
            <div class="container form-input-wrapper">
                <div class="col-lg-1 col-md-1 col-sm-1">
                    <?php
                        $model->isNewRecord ? $current_date : [$model->previous_school_from_school_year, $model->previous_school_to_school_year];
                        $parsed_date = (int) substr($current_date, 0, 4);
                    ?>
                    <?=
                        $model->isNewRecord ? $form->field($model, 'previous_school_from_school_year')->textInput(['value' => $current_date])->label(false) : $form->field($model, 'previous_school_from_school_year')->textInput()->label(false);
                    ?>
                </div>
                <div class="col-lg-1 col-md-1 col-sm-1">
                    <?=
                        $model->isNewRecord ? $form->field($model, 'previous_school_to_school_year')->textInput(['value' => ($parsed_date + 1)])->label(false) : $form->field($model, 'previous_school_to_school_year')->textInput()->label(false);
                    ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="container form-input-wrapper">
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <?= $form->field($model, 'student_id')->widget(Select2::classname(), [
                            'data' => ArrayHelper::map(StudentForm::find()->all(),'id', function($model){return $model->id . ' ' . $model->last_name . ', ' . $model->first_name . ' ' . $model->middle_name;}),
                            'language' => 'en',
                            'options' => ['id' => 'auto-suggest','placeholder' => 'Enter ID #'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ])->label(false); 
                    ?>
                </div>
                <?= $model->isNewRecord ? '' : '<div class="col-lg-2 col-md-2 col-sm-12">' . $form->field($model, 'status')->dropDownList(['0' => 'Pending', '1' => 'Enrolled'], ['default' => 'Pending'])->label(false) . '</div>';?>
            </div>
        </div>
        <div class="row">
            <div class="container form-input-wrapper">
                <div class="col-lg-3 col-md-3 col-sm-12">
                    <?= $form->field($model, 'grade_level_id', ['inputTemplate' => '<div class="input-group"><span class="input-group-addon"><span class="dropdown-list">Grade Level</span></span></span>{input}</div>'])->dropDownList($listData, ['id', 'name'])->label(false) ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
</div>