<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\helpers\CssHelper;
use app\models\GradeLevel;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ClassAdviserFormSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Class Adviser Forms';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="class-adviser-form-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Class Adviser Form', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        //'filterPosition'=> 'footer',
        //'showFooter' => true,
        'columns' => [
            [
                'attribute' => 'teacher_id',
                'header' => 'Teacher',
                'value' => function($model){
                    return $model->teacher->last_name . ', ' . $model->teacher->first_name . ' ' . $model->teacher->middle_name;
                },
            ],
            [
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
                'attribute' => 'sy_id',
                'header' => 'School Year',
                'value' => function($model){
                    return $model->sy->sy;
                }
            ],
            ['class' => 'yii\grid\ActionColumn',
                    'header' => "Options",
                    'template' => '{view} {update} {delete}',
                    'options' => ['style' => 'width: 100px; text-align: center; margin: auto;'],
                    'buttons' => [
                        'view' => function ($url, $model, $key) {
                            return Html::a('', $url, ['title'=>'View', 
                                'class'=>'fa fa-user fa-2x']);
                        },
                        'update' => function ($url, $model, $key) {
                            return Html::a('', $url, ['title'=>'Update', 
                                'class'=>'fa fa-edit fa-2x']);
                        },
                        'delete' => function ($url, $model, $key) {
                            return Html::a('', $url, 
                                ['title'=>'Delete Applicant', 
                                    'class'=>'fa fa-times fa-2x fa-remove text-centered',
                                    'data' => [
                                        'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                                        'method' => 'post']
                ]);
                    }
                ]
            ],
        ],
    ]); ?>

</div>
