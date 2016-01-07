<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EntranceExamFormSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Entrance Exam';
?>
<div class="entrance-exam-form-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <p>
        <?= Html::a('<i class="fa fa-plus"></i> New', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'applicant_id',
            'english',
            'reading_skills',
            'science',
            'comprehension',
            'remarks',
            'recommendations',
            /*
            'created_at:date',
            [
                'attribute' => 'updated_at',
                'value' => function($model){
                    return \Carbon\Carbon::createFromTimestamp($model->updated_at, 'Asia/Manila')->diffForHumans();
                }
            ],*/
            ['class' => 'yii\grid\ActionColumn',
                    'header' => "Options",
                    'template' => '{view} {update} {delete}',
                    'options' => ['style' => 'width: 100px; text-align: center; margin: auto;'],
                    'buttons' => [
                        'view' => function ($url, $model, $key) {
                            return Html::a('', $url, ['title'=>'View Examinee', 
                                'class'=>'fa fa-user fa-2x']);
                        },
                        'update' => function ($url, $model, $key) {
                            return Html::a('', $url, ['title'=>'Update Examinee', 
                                'class'=>'fa fa-edit fa-2x']);
                        },
                        'delete' => function ($url, $model, $key) {
                            return Html::a('', $url, 
                                ['title'=>'Delete Applicant', 
                                    'class'=>'fa fa-times fa-2x fa-remove text-centered',
                                    'data' => [
                                        'confirm' => Yii::t('app', 'Are you sure you want to delete this record?'),
                                        'method' => 'post']
                ]);
                    }
                ]
            ],
        ],
    ]); ?>

</div>
