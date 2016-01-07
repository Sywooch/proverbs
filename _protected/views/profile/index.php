<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProfileFormSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Profile';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-form-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'username',
            //'password_hash',
            // 'status',
            // 'auth_key',
            // 'password_reset_token',
            // 'account_activation_token',
            // 'created_at',
            // 'updated_at',
            'first_name',
            'middle_name',
            'last_name',
            'email:email',
            // 'gender',
            // 'birth_date',
            // 'address',
            // 'phone',
            // 'mobile',
            // 'notes',

            ['class' => 'yii\grid\ActionColumn',
            'header' => "Options",
            'template' => '{view} {update} {delete}',
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return Html::a('', $url, ['title'=>'View user', 
                            'class'=>'fa fa-user fa-2x']);
                    },
                    'update' => function ($url, $model, $key) {
                        return Html::a('', $url, ['title'=>'Manage user', 
                            'class'=>'fa fa-edit fa-2x']);
                    },
                    'delete' => function ($url, $model, $key) {
                        return Html::a('', $url, 
                        ['title'=>'Delete user', 
                            'class'=>'fa fa-times fa-2x fa-remove',
                            'data' => [
                                'confirm' => Yii::t('app', 'Are you sure you want to delete this user?'),
                                'method' => 'post']
                        ]);
                    }
                ]
            ], // ActionColumn
        ],
    ]); ?>

</div>