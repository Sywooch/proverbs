<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use app\models\User;
/* @var $this yii\web\View */
/* @var $searchModel app\models\MessageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Messages';
?>
<div class="message-index">
    <p>
        <?= Html::a('<i class="fa fa-plus"></i> New Message', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
        <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'layout'=>"{summary}\n{items}\n{pager}",
        'columns' => [
            //['class' => 'yii\grid\CheckboxColumn']
            [
                'attribute' => 'sender',
                'value' => function($model){
                    return $model->senderName->username;
                }
            ],
            'content',
            [
                'attribute' => 'created_at',
                'options' => ['style' => 'width: 150px;'],
                'value' => function($model){
                    return \Carbon\Carbon::parse($model->created_at, 'Asia/Manila')->diffForHumans();
                }
            ],
            ['class' => 'yii\grid\ActionColumn',
                'header' => "Options",
                'template' => '{view} {delete}',
                'options' => ['style' => 'width: 50px;'],
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return Html::a('', $url, ['title'=>'View user', 
                            'class'=>'fa fa-user fa-2x']);
                    },
                    'delete' => function ($url, $model, $key) {
                        return Html::a('', $url, 
                            ['title'=>'Delete user', 
                                'class'=>'fa fa-times fa-2x fa-remove text-centered',
                                'data' => [
                                    'confirm' => Yii::t('app', 'Are you sure you want to delete this user?'),
                                    'method' => 'post']
                        ]);
                    }
                ]
            ],
        ],
    ]); ?>
</div>
