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
$grade_level = GradeLevel::find()->where(['!=', 'id', 0])->all();

$listData = ArrayHelper::map($grade_level, 'id' , 'name');
$listData2 = ArrayHelper::map($school_year, 'id' , 'sy');
$listData3 = ArrayHelper::map($section, 'id' , 'section_name');
$state = false;
?>
<div class="enrollment-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="container form-input-wrapper">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <?= $form->field($model, 'enrollment_status', ['inputTemplate' => '<div class="input-group"><span class="input-group-addon"><span class="dropdown-list">Enrollment Status</span></span></span>{input}</div>'])->dropDownList(['0' => 'Pending', '1' => 'Enrolled'], ['default' => 'Pending'])->label(false) ?>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <?= $form->field($model, 'sy_id', ['inputTemplate' => '<div class="input-group"><span class="input-group-addon"><span class="dropdown-list">School Year</span></span></span>{input}</div>'])->dropDownList($listData2, ['id', 'sy'])->label(false) ?>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12">
                
                    <?= $form->field($model, 'student_id')->widget(Select2::classname(), [
                            'data' => ArrayHelper::map(StudentForm::find()->all(),'id', function($model){return $model->id . ' ' . $model->last_name . ', ' . $model->first_name . ' ' . $model->middle_name;}),
                            'language' => 'en',
                            'options' => ['id' => 'auto-suggest','placeholder' => 'Select Student'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                            'pluginEvents' => [
                                'change' => "
                                    function(){
                                        $.post('". Yii::$app->urlManager->createUrl('enroll/grade-level?id=') . "'+parseInt($('#auto-suggest').val()), function(data){
                                            $('select#enrolledform-grade_level_id').val(data);

                                            $.post('". Yii::$app->urlManager->createUrl('enroll/section?id=') . "'+parseInt($('#enrolledform-grade_level_id').val()), function(data){
                                                $('#enrolledform-section_id').find('option').remove();
                                                $('#enrolledform-section_id').each(function(){
                                                    $(this).append(data);
                                                });
                                            });
                                        });
                                    }
                                ",
                            ],
                        ])->label(false); 
                    ?>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <?= $form->field($model, 'grade_level_id', ['inputTemplate' => '<div class="input-group"><span class="input-group-addon"><span class="dropdown-list">Grade Level</span></span></span>{input}</div>'])->dropDownList($listData,
                    [
                        'onchange' => "
                            $.post('". Yii::$app->urlManager->createUrl('enroll/section?id=') . "'+parseInt($('#enrolledform-grade_level_id').val()), function(data){
                                $('#enrolledform-section_id').find('option').remove();
                                $('#enrolledform-section_id').each(function(){
                                    $(this).append(data);
                                });
                            });
                        ",
                    ])->label(false) ?>
                </div>       
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <?= $form->field($model, 'section_id', ['inputTemplate' => '<div class="input-group"><span class="input-group-addon"><span class="dropdown-list">Section</span></span></span>{input}</div>'])->dropDownList($listData3, ['id', 'section_name'])->label(false) ?>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="form-group">
                        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                        <?= Html::a(Yii::t('app', 'Cancel'), ['/enroll'], ['class' => 'btn btn-default']) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>