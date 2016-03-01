<?php
use yii\helpers\Html;
use kartik\select2\Select2;
use app\models\ActiveRecord;
use yii\helpers\ArrayHelper;
use app\models\SchoolYear;
use app\models\GradeLevel;
use app\models\User;
use app\models\Section;
use yii\bootstrap\ActiveForm;

$teachers = User::find()->joinWith('role')->where(['item_name' => 'teacher'])->orderBy(['last_name' => SORT_ASC])->all();
$grade_level = GradeLevel::find()->all();
$section = Section::find()->all();
$school_year = SchoolYear::find()->orderBy(['id' => SORT_DESC])->all();

$listData_grade_level = ArrayHelper::map($grade_level, 'id' , 'name');
$listData_school_year = ArrayHelper::map($school_year, 'id' , 'sy');
$listData_section = ArrayHelper::map($section, 'id' , 'section_name');
$listData_teachers = ArrayHelper::map($teachers, 'id' , 'last_name');
?>

<div class="class-adviser-form-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="container form-input-wrapper">
    		<div class="col-lg-3 col-md-3 col-sm-12">
    			<?= $form->field($model, 'sy_id', ['inputTemplate' => '<div class="input-group"><span class="input-group-addon"><span class="dropdown-list">School Year</span></span></span>{input}</div>'])->dropDownList($listData_school_year, ['id', 'sy'])->label(false) ?>
			</div>
		</div>
	</div>
    <div class="row">
        <div class="container form-input-wrapper">
    		<div class="col-lg-3 col-md-3 col-sm-12">

			</div>
		</div>
	</div>
    <div class="row">
        <div class="container form-input-wrapper">
            <div class="col-lg-3 col-md-3 col-sm-12">
                <?= $form->field($model, 'grade_level_id', ['inputTemplate' => '<div class="input-group"><span class="input-group-addon"><span class="dropdown-list">Grade Level</span></span></span>{input}</div>'])->dropDownList($listData_grade_level, ['id', 'name'])->label(false) ?>
            </div>
    		<div class="col-lg-3 col-md-3 col-sm-12">
                <?= $model->isNewRecord ?
                    $form->field($model, 'section_id')->widget(Select2::classname(), [
                        'data' => ArrayHelper::map(Section::find()->orderBy(['section_name' => SORT_ASC])->all(),'id', function($model){return $model->section_name;}),
                        'language' => 'en',
                        'options' => ['id' => 'auto-suggest','placeholder' => 'Select Section'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ])->label(false) 
                    : 
                    $form->field($model, 'section_id')->widget(Select2::classname(), [
                        'data' => ArrayHelper::map(Section::find()->orderBy(['section_name' => SORT_ASC])->all(),'id', function($model){return $model->section_name;}),
                        'language' => 'en',
                        'options' => ['id' => 'auto-suggest','placeholder' => 'Select Section'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ])->label(false) 
                    ;
                ?>
			</div>
		</div>
	</div>
    <div class="row">
        <div class="container form-input-wrapper">
            <div class="col-lg-3 col-md-3 col-sm-12">
                <?= $model->isNewRecord ?
                    $form->field($model, 'teacher_id')->widget(Select2::classname(), [
                        'data' => ArrayHelper::map(User::find()->joinWith('role')->where(['item_name' => 'teacher'])->orderBy(['last_name' => SORT_ASC])->all(),'id', function($model){return $model->last_name . ', ' . $model->first_name . ' ' . $model->middle_name . ' (' . $model->username . ') ';}),
                        'language' => 'en',
                        'options' => ['id' => 'auto-suggest2','placeholder' => 'Select Teacher'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ])->label(false) 
                    : 
                    $form->field($model, 'teacher_id')->widget(Select2::classname(), [
                        'data' => ArrayHelper::map(User::find()->joinWith('role')->where(['item_name' => 'teacher'])->orderBy(['last_name' => SORT_ASC])->all(),'id', function($model){return $model->last_name . ', ' . $model->first_name . ' ' . $model->middle_name . ' (' . $model->username . ') ';}),
                        'language' => 'en',
                        'options' => ['id' => 'auto-suggest2','placeholder' => 'Select Teacher'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ])->label(false) 
                    ;
                ?>
            </div>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
