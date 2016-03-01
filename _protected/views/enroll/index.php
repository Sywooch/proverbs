<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\helpers\CssHelper;
use app\models\GradeLevel;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EnrolledFormSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$gradeLevel = GradeLevel::find()->select('id')->all();
$this->title = 'Enroll';
?>
<div class="enrollment-form-index">
    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>
    <p>
        <?= Html::a('<i class="fa fa-plus"></i> New Enrollment Form', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'layout'=>"{summary}\n{items}\n{pager}",
        'columns' => [
            'student_id',
            'student.last_name',
            'student.first_name',
            'student.middle_name',
            /*[
                'attribute' => 'student_id',
                'value' => function($model){
                    return $model->student_id . ' ' .$model->student->last_name . ',' . $model->student->last_name . ' ' . $model->student->middle_name;
                }
            ],*/
            /*[
                'attribute' => 'student_id',
                'value' => function($data){
                    return $data->student->last_name;
                }
            ],
            [
                'attribute' => 'student_id',
                'value' => function($data){
                    return $data->student->first_name;
                }
            ],*/
            /*[
                'attribute' => 'student_id',
                'value' => function($model){
                    return $model->student->first_name;
                },
                'contentOptions'=>function($column) {
                    return ['header' => 'fdadf'];
                }
            ],*/
            /*[
                'attribute' => 'student_id',
                'value' => function($model){
                    return $model->student->last_name;
                }
            ],*/
/*            [
                'attribute' => 'grade_level_id',
                'value' => function($model){
                    return $model->gradeLevel->name;
                }
            ],
*/          [
                'attribute'=>'grade_level_id',
                'filter' => $searchModel->levelList,
                'value' => function ($data) {
                    return $data->levelName;
                },
                'contentOptions'=>function($model, $key, $index, $column) {
                    return ['class'=>CssHelper::statusCss($model->levelName)];
                }
            ],
            [
                'attribute'=>'enrollment_status',
                'filter' => $searchModel->statusList,
                'value' => function ($data) {
                    return $data->statusName;
                },
                'contentOptions'=>function($model, $key, $index, $column) {
                    return ['class'=>CssHelper::statusCss($model->statusName)];
                }
            ],
            [
                'attribute' => 'sy_id',
                'value' => function($data){
                    return $data->sy->sy;
                }
            ],
            //'from_school_year',
            //'to_school_year',
            //'created_at:date',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn',
                    'header' => "Options",
                    'template' => '{payment} {view} {update} {delete}',
                    'options' => ['style' => 'width: 120px; text-align: center; margin: auto;'],
                    'buttons' => [
                        'payment' => function ($url, $model, $key) {
                            return Html::a('', Yii::$app->request->baseUrl . '/payments/new?id=' . $model->student_id, ['title'=>'New Payment', 
                                'class'=>'fa fa-dollar fa-2x']);
                        },
                        'view' => function ($url, $model, $key) {
                            return Html::a('', $url, ['title'=>'View', 
                                'class'=>'fa fa-check fa-2x']);
                        },
                        'update' => function ($url, $model, $key) {
                            return Html::a('', $url, ['title'=>'Update', 
                                'class'=>'fa fa-pencil fa-2x']);
                        },
                        'delete' => function ($url, $model, $key) {
                            return Html::a('', $url, 
                                ['title'=>'Delete Applicant', 
                                    'class'=>'fa fa-trash-o fa-2x fa-remove text-centered',
                                    'data' => [
                                        'confirm' => Yii::t('app', 'Are you sure you want to delete this payment?'),
                                        'method' => 'post']
                ]);
                    }
                ]
            ],
        ],
    ]); ?>

</div>
