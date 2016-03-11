<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\AnnouncementSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Announcements';
?>
<div class="announcement-index">
    <p>
        <?= Html::a('<i class="fa fa-plus"></i> New Announcement', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            /*[
                'class' => 'yii\grid\CheckboxColumn',
            ],*/
            'content',
            //'created_at:date',
            /*[
                'attribute' => 'updated_at',
                'value' => function($model){
                    $dt = date('Y-m-d H:i:s', $model->updated_at);
                    return \Carbon\Carbon::parse($dt)->diffForHumans();
                }
            ],*/
            ['class' => 'yii\grid\ActionColumn',
                    'header' => "Options",
                    'template' => '{view} {update} {delete}',
                    'options' => ['style' => 'width: 100px;'],
                    'buttons' => [
                        'view' => function ($url, $model, $key) {
                            return Html::a('', $url, ['title'=>'View Announcement', 
                                'class'=>'fa fa-user fa-2x']);
                        },
                        'update' => function ($url, $model, $key) {
                            return Html::a('', $url, ['title'=>'Update Announcement', 
                                'class'=>'fa fa-edit fa-2x']);
                        },
                        'delete' => function ($url, $model, $key) {
                            return Html::a('', $url, 
                                ['title'=>'Delete Announcement', 
                                    'class'=>'fa fa-times fa-2x fa-remove text-centered',
                                    'data' => [
                                        'confirm' => Yii::t('app', 'Are you sure you want to delete this announcement?'),
                                        'method' => 'post']
                                ]);
                    }
                ]
            ],
        ],
    ]); ?>
</div>
