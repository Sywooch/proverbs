<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\helpers\CssHelper;
use app\models\GradeLevel;
use app\models\EnrolledForm;
use app\models\EnrolledFormSearch;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EnrolledFormSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$gradeLevel = GradeLevel::find()->select('id')->all();
$this->title = 'Enroll';
$breadcrumbs[] = ['label' => 'index', 'url' => 'dfa'];
$this->params['breadcrumbs'][] = ['label' => 'Enroll', 'url' => ['index']];
?>
<p></p>
<div class="enrollment-form-index">
    <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-12">
            <div class="panel panel-default">
                <div class="panel-body">
                <div class="pull-right" style="margin-bottom: 10px;"><?= Html::a('<i class="fa fa-plus" style="margin-top: 3px;"></i> New', ['create'], ['class' => 'btn btn-md btn-success']) ?></div>
                    <h4>Enrollee</h4>
                    <hr class="hr-full-width">
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        //'filterModel' => $searchModel,
                        'layout'=>"<div class='gridview-summary'>{summary}</div>{items}<div class='text-centered'>{pager}</div>",
                        'columns' => [
                            'student_id',
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
                            // [
                            //     'attribute'=>'enrollment_status',
                            //     'filter' => $searchModel->statusList,
                            //     'value' => function ($data) {
                            //         return $data->statusName;
                            //     },
                            //     'contentOptions'=>function($model, $key, $index, $column) {
                            //         return ['class'=>CssHelper::statusCss($model->statusName)];
                            //     }
                            // ],
                            // [
                            //     'attribute' => 'sy_id',
                            //     'filter' => $searchModel->syList,
                            //     'value' => function($data){
                            //         return $data->sy->sy;
                            //     },
                            // ],
                            [
                                'class' => 'yii\grid\ActionColumn',
                                    'header' => "Options",
                                    'template' => '<div id="options-column">{view} {update} {delete} {assessment} {payment} {more}</div>',
                                    'buttons' => [
                                        'view' => function ($url, $model, $key) {
                                            return Html::a('<small>View</small>', $url, ['title'=>'View', 
                                                'class'=>'btn btn-info btn-xs ac-options-btn']);
                                        },
                                        'update' => function ($url, $model, $key) {
                                            return Html::a('<small>Edit</small>', $url, ['title'=>'Update', 
                                                'class'=>'btn btn-primary btn-xs ac-options-btn']);
                                        },
                                        'delete' => function ($url, $model, $key) {
                                            return Html::a('<small>Delete</small>', $url, 
                                                ['title'=>'Delete', 
                                                    'class'=>'btn btn-danger btn-xs ac-options-btn',
                                                    'data' => [
                                                        'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                                                        'method' => 'post']
                                            ]);
                                        },
                                        'more' => function ($url, $model, $key) {
        
                                                if(Yii::$app->controller->checkAssessment($key) !== null){
                                                    $assessment = Html::a('<small>View Assessment</small>', Yii::$app->request->baseUrl . '/assessment/view?id=' . Yii::$app->controller->checkAssessment($key)[0]['id'], ['title'=>'Assessment', 'class'=>'btn btn-primary btn-xs ac-options-btn']);
                                                } else {
                                                    $assessment = Html::a('<small>New Assessment</small>', Yii::$app->request->baseUrl . '/assessment/new?eid=' . $model->id, ['title'=>'Assessment', 'class'=>'btn btn-primary btn-xs ac-options-btn']);
                                                }

                                                $payment = Html::a('<small>Payment</small>', Yii::$app->request->baseUrl . '/payments/new?id=' . $model->student_id, ['title'=>'New Payment', 'class'=>'btn btn-success btn-xs ac-options-btn']);
                                                return ' | ' . Html::button('<small>More</small>', [ 'id' => 'gridview-more-btn', 'data-container' => 'body', 
                                                    'data-toggle' => 'popover', 'data-placement' => 'top',  
                                                    'class' => 'ac-options-btn btn-popover-options', 
                                                    'data-html' => 'true',
                                                    'data-content' => 
                                                        '<div id="enroll-popover-more">
                                                            <ul>
                                                                <li>' . $assessment . '</li>
                                                                <li>' . $payment . '</li>
                                                            </ul>
                                                        </div>'
                                            ]);
                                        },
                                ]
                            ],
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <?php // Html::a('New', ['create'], ['class' => 'btn btn-success btn-block']) ?>
                    <h4>Search</h4>
                    <hr class="hr-full-width">
                    <?= $this->render('_search', ['model' => $searchModel, 'listData' => $listData, 'listData2' => $listData2]) ?>
                </div>
            </div>
        </div>
    </div>
</div>