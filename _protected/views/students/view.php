<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ApplicantForm */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Students', 'url' => ['index']];
?>
<div class="student-form-view">
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'status',
                'value' => $model->getStatus($model->status), // 0:INACTIVE 1:ACTIVE 2: APPLICANT (DEFAULT)
            ],
            [
                'attribute' => 'grade_level_id',
                'value' => $model->getGradeLevelId($model->grade_level_id),
            ],
            'first_name',
            'middle_name',
            'last_name',
            'nickname',
            [
                'attribute' => 'gender',
                'value' => $model->getGender($model->gender)
            ],
            [
                'attribute' => 'birth_date',
                'value' => $model->getBirthdate($model->birth_date) //DATE IN CARBON FORMAT
            ],
            'religion',
            'citizenship',
            'address',
            'zip_code',
            'mobile',
            'phone',
            'fathers_name',
            'fathers_occupation',
            'fathers_employer',
            'fathers_citizenship',
            'fathers_religion',
            'fathers_email:email',
            'fathers_mobile',
            'fathers_phone',
            [
                'attribute' => 'father_is',
                'value' => $model->getFatherIs($model->father_is) //0:Living 1: Deceased
            ],
            'mothers_name',
            'mothers_occupation',
            'mothers_employer',
            'mothers_citizenship',
            'mothers_religion',
            'mothers_email:email',
            'mothers_mobile',
            'mothers_phone',
            [
                'attribute' => 'mother_is',
                'value' => $model->getMotherIs($model->mother_is) //0:Living 1:Deceased
            ],
            [
                'attribute' => 'parents_are',
                'value' => $model->getParentsAre($model->parents_are) //0:Together 1:Separated 2:Widowed 3:Single 4:Marriage Anulled
            ],
            'guardians_name',
            'guardians_profile_image',
            'guardians_address',
            'guardians_relation_to_student',
            'guardians_occupation',
            'guardians_employer',
            'guardians_phone',
            'guardians_mobile',
            'previous_school_name',
            'previous_school_description',
            'previous_school_address',
            'previous_school_phone',
            'previous_school_mobile',
            [
                'attribute' => 'previous_school_grade_level',
                'value' => $model->getGradeLevelId($model->previous_school_grade_level)
            ],
            'previous_school_average_grade',
            'previous_school_teacher_in_charge',
            'previous_school_principal',
            [
                'attribute' => 'student_has_sibling_enrolled',
                'value' => $model->getHasSiblingEnrolled($model->student_has_sibling_enrolled)
            ],
            [
                'attribute' => 'student_photo',
                'value' => $model->getSubmitted($model->student_photo)
            ],
            [
                'attribute' => 'guardians_photo',
                'value' => $model->getSubmitted($model->guardians_photo)
            ],
            [
                'attribute' => 'birth_certificate',
                'value' => $model->getSubmitted($model->birth_certificate)
            ],
            [
                'attribute' => 'report_card',
                'value' => $model->getSubmitted($model->report_card)
            ],
            [
                'attribute' => 'good_moral',
                'value' => $model->getSubmitted($model->good_moral)
            ],
            'from_school_year',
            'to_school_year',
            'created_at:date',
            [
                'attribute' => 'updated_at',
                'value' => $model->getUpdatedAt($model->updated_at)
            ],
        ],
    ]) ?>

</div>
