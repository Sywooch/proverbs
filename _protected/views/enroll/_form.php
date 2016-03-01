<?php

use yii\web\View;
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use kartik\select2\Select2;
use app\models\ApplicantForm;
use app\models\ActiveRecord;
use app\models\StudentForm;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use app\models\GradeLevel;
use app\models\Section;
use app\models\SchoolYear;
$current_date = date('Y');
$school_year = SchoolYear::find()->orderBy(['id' => SORT_DESC])->all();
$section = Section::find()->all();
$grade_level = GradeLevel::find()->all();

$listData = ArrayHelper::map($grade_level, 'id' , 'name');
$listData2 = ArrayHelper::map($school_year, 'id' , 'sy');
$listData3 = ArrayHelper::map($section, 'id' , 'section_name');
$state = false;
?>
<div class="enrollment-form">
        <?php $form = ActiveForm::begin(); ?>
        <div class="row">
            <div class="container form-input-wrapper">
                <div class="col-lg-3 col-md-3 col-sm-12">
                    <?= $form->field($model, 'enrollment_status',['inputTemplate' => '{input}', 'inputOptions' => ['type' => 'checkbox', 'class' => 'js-switch-small', 'data-switchery' => true]])->label()?>
                    <?php // $form->field($model, 'enrollment_status',['inputTemplate' => '{input}', 'inputOptions' => ['type' => 'checkbox', 'class' => 'js-switch-small', 'data-switchery' => true]])->label()?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="container form-input-wrapper">
                <div class="col-lg-3 col-md-3 col-sm-12">
                    <?= $form->field($model, 'sy_id', ['inputTemplate' => '<div class="input-group"><span class="input-group-addon"><span class="dropdown-list">School Year</span></span></span>{input}</div>'])->dropDownList($listData2, ['id', 'sy'])->label(false) ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="container form-input-wrapper">
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <?= $form->field($model, 'student_id')->widget(Select2::classname(), [
                            'data' => ArrayHelper::map(StudentForm::find()->all(),'id', function($model){return $model->id . ' ' . $model->last_name . ', ' . $model->first_name . ' ' . $model->middle_name;}),
                            'language' => 'en',
                            'options' => ['id' => 'auto-suggest','placeholder' => 'Select Student'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ])->label(false); 
                    ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="container form-input-wrapper">
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <?= $form->field($model, 'section_id')->widget(Select2::classname(), [
                            'data' => ArrayHelper::map(Section::find()->all(),'id', function($model){return $model->section_name;}),
                            'language' => 'en',
                            'options' => ['id' => 'auto-suggest2','placeholder' => 'Select Section'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ])->label(false); 
                    ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="container form-input-wrapper">
                <div class="col-lg-3 col-md-3 col-sm-12">
                    <?=
                        $model->isNewRecord ? 
                            $form->field($model, 'grade_level_id', ['inputTemplate' => '<div class="input-group"><span class="input-group-addon"><span class="dropdown-list">Grade Level</span></span></span>{input}</div>'])->dropDownList($listData, ['id', 'name'])->label(false) 
                            :
                            $form->field($model, 'grade_level_id', ['inputTemplate' => '<div class="input-group"><span class="input-group-addon"><span class="dropdown-list">Grade Level</span></span></span>{input}</div>'])->dropDownList($listData, ['id', 'name'])->label(false);
                    ?>                    
                </div>
            </div>`
        </div>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            <?= Html::a(Yii::t('app', 'Cancel'), ['/enroll'], ['class' => 'btn btn-default']) ?>
        </div>

        <?php ActiveForm::end(); ?>
</div>
<?php
    if(!$model->isNewRecord && $model->enrollment_status === 1){
        $this->registerJs(
        "var sw = $('#enrolledform-enrollment_status');"
        . "var target = $('span.switchery.switchery-small > small');"
        . "var state = 1;"
        . "var init = 0;"

        . "function removeChecked(){sw.attr('test','1');}"
        . "function addChecked(){sw.attr('checked','checked');}"

        . "function es0(){sw.val(0); state=0; console.log('val: '+ sw.val() + ' state: ' + state); }"
        . "function es1(){sw.val(1); state=1;  console.log('val: '+ sw.val() + ' state: ' + state); }"
        . "console.log('val: '+ sw.val() + ' state: ' + state);"
        
        . "sw.attr('checked','checked');}"

        . "target.click(function(){
                if(state === 1){
                    es0();
                    removeChecked();
                } else {
                    es1();
                    addChecked();
                }    
            }
        );"

        ,View::POS_LOAD);
    }
?>