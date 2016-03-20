<?php

use yii\web\View;
use yii\helpers\HtmlPurifier;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use app\models\GradeLevel;
use app\models\Section;
use app\models\Subject;
use app\models\LearningArea;
use app\models\TeacherForm;
use app\models\User;
use app\models\SchoolYear;

$current_date = date('Y');
$school_year = SchoolYear::find()->orderBy(['id' => SORT_DESC])->all();
$section = Section::find()->all();
$subject = Subject::find()->all();
$teacher = User::find()->join('LEFT JOIN','auth_assignment','auth_assignment.user_id = id')->where(['auth_assignment.item_name' => 'teacher'])->all();
//$teacher = User::find()->joinWith('role')->where(['item_name' => 'teacher'])->all();
$grade_level = GradeLevel::find()->all();

$sy_list = ArrayHelper::map($school_year, 'id' , 'sy');
$teacher_list = ArrayHelper::map($teacher, 'id' , 'last_name');
$grade_level_list = ArrayHelper::map($grade_level, 'id' , 'name');
$section_list = ArrayHelper::map($section, 'id' , 'section_name');
$subject_list = ArrayHelper::map($subject, 'id' , 'subject_name');
?>

<div class="assigned-form-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="container form-input-wrapper">
            <div class="col-lg-3 col-md-3 col-sm-12">
                <?= $form->field($model, 'sy_id', ['inputTemplate' => '<div class="input-group"><span class="input-group-addon"><span class="dropdown-list">School Year</span></span></span>{input}</div>'])->dropDownList($sy_list, ['id', 'sy'])->label(false) ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="container form-input-wrapper">
            <div class="col-lg-3 col-md-3 col-sm-12">
                <?=
                $form->field($model, 'grade_level_id', ['inputTemplate' => '<div class="input-group"><span class="input-group-addon"><span class="dropdown-list">Grade Level</span></span></span>{input}</div>'])
                    ->dropDownList($grade_level_list,
                    	[
				           'onchange'=>'
                                $.post( "'. Yii::$app->urlManager->createUrl('assign-subject/lists?id=') . '"+$(this).val(), function( data ) {
                                $( "select#assignedform-subject_id" ).html(data);
				                
                                $.post( "'. Yii::$app->urlManager->createUrl('assign-subject/section?id=') . '"+parseInt($("#assignedform-grade_level_id").val()), function( data ) {
                                    $("#assignedform-section_id").find("option").remove();
                                    $("#assignedform-section_id").each(function(){
                                        $(this).append(data);
                                    });
                                });
				           });
				      '])
                    ->label(false)
                ?>                    
            </div>
        </div>`
    </div>
    <div class="row">
        <div class="container form-input-wrapper">
            <div class="col-lg-3 col-md-3 col-sm-12">
                <?= $form->field($model, 'section_id', ['inputTemplate' => '<div class="input-group"><span class="input-group-addon"><span class="dropdown-list">Section</span></span></span>{input}</div>'])->dropDownList($section_list, ['id', 'section_name'])->label(false) ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="container form-input-wrapper">
            <div class="col-lg-4 col-md-4 col-sm-12">
                <?= $form->field($model, 'subject_id', ['inputTemplate' => '<div class="input-group"><span class="input-group-addon"><span class="dropdown-list">Subject</span></span></span>{input}</div>'])->dropDownList($subject_list, ['subject_id', 'subject_name'])->label(false) ?>
                <?php //$form->field($model, 'subject_id', ['inputTemplate' => '<div class="input-group"><span class="input-group-addon"><span class="dropdown-list">Subject</span></span></span>{input}</div>'])->dropDownList($subject_list, ['subject_id', 'subject_name'])->label(false) ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="container form-input-wrapper">
            <div class="col-lg-4 col-md-4 col-sm-12">
                <?= $form->field($model, 'teacher_id')->widget(Select2::classname(), [
                        'data' => ArrayHelper::map(User::find()->joinWith('role')->where(['item_name' => 'teacher'])->all(),'id', function($model){return $model->last_name . ', ' . $model->first_name . ' ' . $model->middle_name;}),
                        'language' => 'en',
                        'options' => ['id' => 'auto-suggest','placeholder' => 'Select Teacher'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ])->label(false); 
                ?>
            </div>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
