<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ApplicantFormSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Applicant';
?>
<div class="applicant-form-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('<i class="fa fa-plus"></i> New Applicant', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'first_name',
            'middle_name',
            'last_name',
            'nickname',
            // 'gender',
            // 'birth_date',
            // 'religion',
            // 'citizenship',
            // 'address',
            // 'zip_code',
            // 'mobile',
            // 'phone',
            // 'status',
            // 'fathers_name',
            // 'fathers_occupation',
            // 'fathers_employer',
            // 'fathers_citizenship',
            // 'fathers_religion',
            // 'fathers_email:email',
            // 'fathers_mobile',
            // 'fathers_phone',
            // 'father_is_deceased',
            // 'mothers_name',
            // 'mothers_occupation',
            // 'mothers_employer',
            // 'mothers_citizenship',
            // 'mothers_religion',
            // 'mothers_email:email',
            // 'mothers_mobile',
            // 'mothers_phone',
            // 'mother_is_deceased',
            // 'parents_are',
            // 'guardians_name',
            // 'guardians_profile_image',
            // 'guardians_address',
            // 'guardians_relation_to_student',
            // 'guardians_occupation',
            // 'guardians_employer',
            // 'guardians_phone',
            // 'guardians_mobile',
            // 'student_is_living_with',
            // 'grade_level_id',
            // 'sibling_id',
            // 'entrance_exam_id',
            // 'requirements_id',
            // 'previous_school_name',
            // 'previous_school_description',
            // 'previous_school_address',
            // 'previous_school_phone',
            // 'previous_school_mobile',
            // 'previous_school_grade_level',
            // 'previous_school_average_grade',
            // 'previous_school_teacher_in_charge',
            // 'previous_school_principal',
            // 'from_school_year',
            // 'to_school_year',
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn',
                    'header' => "Options",
                    'template' => '{view} {update} {delete}',
                    'options' => ['style' => 'width: 100px; text-align: center; margin: auto;'],
                    'buttons' => [
                        'view' => function ($url, $model, $key) {
                            return Html::a('', $url, ['title'=>'View Applicant', 
                                'class'=>'fa fa-user fa-2x']);
                        },
                        'update' => function ($url, $model, $key) {
                            return Html::a('', $url, ['title'=>'Update Applicant', 
                                'class'=>'fa fa-edit fa-2x']);
                        },
                        'delete' => function ($url, $model, $key) {
                            return Html::a('', $url, 
                                ['title'=>'Delete Applicant', 
                                    'class'=>'fa fa-times fa-2x fa-remove text-centered',
                                    'data' => [
                                        'confirm' => Yii::t('app', 'Are you sure you want to delete this applicant?'),
                                        'method' => 'post']
                ]);
                    }
                ]
                ],
        ],
    ]); ?>

</div>
