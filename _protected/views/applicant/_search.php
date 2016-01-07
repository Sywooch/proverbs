<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ApplicantFormSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="applicant-form-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'first_name') ?>

    <?= $form->field($model, 'middle_name') ?>

    <?= $form->field($model, 'last_name') ?>

    <?= $form->field($model, 'nickname') ?>

    <?php // echo $form->field($model, 'gender') ?>

    <?php // echo $form->field($model, 'birth_date') ?>

    <?php // echo $form->field($model, 'religion') ?>

    <?php // echo $form->field($model, 'citizenship') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'zip_code') ?>

    <?php // echo $form->field($model, 'mobile') ?>

    <?php // echo $form->field($model, 'phone') ?>

    <?php // echo $form->field($model, 'fathers_name') ?>

    <?php // echo $form->field($model, 'fathers_occupation') ?>

    <?php // echo $form->field($model, 'fathers_employer') ?>

    <?php // echo $form->field($model, 'fathers_citizenship') ?>

    <?php // echo $form->field($model, 'fathers_religion') ?>

    <?php // echo $form->field($model, 'fathers_email') ?>

    <?php // echo $form->field($model, 'fathers_mobile') ?>

    <?php // echo $form->field($model, 'fathers_phone') ?>

    <?php // echo $form->field($model, 'father_is_deceased') ?>

    <?php // echo $form->field($model, 'mothers_name') ?>

    <?php // echo $form->field($model, 'mothers_occupation') ?>

    <?php // echo $form->field($model, 'mothers_employer') ?>

    <?php // echo $form->field($model, 'mothers_citizenship') ?>

    <?php // echo $form->field($model, 'mothers_religion') ?>

    <?php // echo $form->field($model, 'mothers_email') ?>

    <?php // echo $form->field($model, 'mothers_mobile') ?>

    <?php // echo $form->field($model, 'mothers_phone') ?>

    <?php // echo $form->field($model, 'mother_is_deceased') ?>

    <?php // echo $form->field($model, 'parents_are') ?>

    <?php // echo $form->field($model, 'guardians_name') ?>

    <?php // echo $form->field($model, 'guardians_profile_image') ?>

    <?php // echo $form->field($model, 'guardians_address') ?>

    <?php // echo $form->field($model, 'guardians_relation_to_student') ?>

    <?php // echo $form->field($model, 'guardians_occupation') ?>

    <?php // echo $form->field($model, 'guardians_employer') ?>

    <?php // echo $form->field($model, 'guardians_phone') ?>

    <?php // echo $form->field($model, 'guardians_mobile') ?>

    <?php // echo $form->field($model, 'student_is_living_with') ?>

    <?php // echo $form->field($model, 'grade_level_id') ?>

    <?php // echo $form->field($model, 'sibling_id') ?>

    <?php // echo $form->field($model, 'entrance_exam_id') ?>

    <?php // echo $form->field($model, 'requirements_id') ?>

    <?php // echo $form->field($model, 'previous_school_name') ?>

    <?php // echo $form->field($model, 'previous_school_description') ?>

    <?php // echo $form->field($model, 'previous_school_address') ?>

    <?php // echo $form->field($model, 'previous_school_phone') ?>

    <?php // echo $form->field($model, 'previous_school_mobile') ?>

    <?php // echo $form->field($model, 'previous_school_grade_level') ?>

    <?php // echo $form->field($model, 'previous_school_average_grade') ?>

    <?php // echo $form->field($model, 'previous_school_teacher_in_charge') ?>

    <?php // echo $form->field($model, 'previous_school_principal') ?>

    <?php // echo $form->field($model, 'from_school_year') ?>

    <?php // echo $form->field($model, 'to_school_year') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
