<?php
use app\helpers\CssHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Cashier');

?>
<div class="cashier-form-index">
    <p><?= Html::a('<i class="fa fa-plus"></i> New Cashier', ['create'], ['class' => 'btn btn-success']) ?></p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summary' => false,
        'columns' => [
            'username',
            'first_name',
            'middle_name',
            'last_name',
            //'email:email',
            [
                'attribute'=>'status',
                'filter' => $searchModel->statusList,
                'value' => function ($data) {
                    return $data->statusName;
                },
                'contentOptions'=>function($model, $key, $index, $column) {
                    return ['class'=>CssHelper::statusCss($model->statusName)];
                }
            ],
            ['class' => 'yii\grid\ActionColumn',
            'header' => "Options",
            'template' => '{view} {update} {delete}',
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return Html::a('', $url, ['title'=>'View Cashier', 
                            'class'=>'fa fa-user fa-2x']);
                    },
                    'update' => function ($url, $model, $key) {
                        return Html::a('', $url, ['title'=>'Manage Cashier', 
                            'class'=>'fa fa-edit fa-2x']);
                    },
                    'delete' => function ($url, $model, $key) {
                        return Html::a('', $url, 
                        ['title'=>'Delete user', 
                            'class'=>'fa fa-times fa-2x fa-remove',
                            'data' => [
                                'confirm' => Yii::t('app', 'Are you sure you want to delete this record?'),
                                'method' => 'post']
                        ]);
                    }
                ]
            ], // ActionColumn
        ], // columns
    ]); ?>

</div>
