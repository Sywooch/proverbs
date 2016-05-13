<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ImageUploadFormSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Image Upload Forms';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="image-upload-form-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Image Upload Form', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            'email:email',
            'password_hash',
            'status',
            // 'auth_key',
            // 'password_reset_token',
            // 'account_activation_token',
            // 'created_at',
            // 'updated_at',
            // 'first_name',
            // 'middle_name',
            // 'last_name',
            // 'gender',
            // 'birth_date',
            // 'address',
            // 'phone',
            // 'mobile',
            // 'notes',
            // 'profile_image',
            // 'last_login',
            // 'last_logout',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
