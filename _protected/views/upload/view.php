<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ImageUploadForm */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Image Upload Forms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="image-upload-form-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            'email:email',
            'password_hash',
            'status',
            'auth_key',
            'password_reset_token',
            'account_activation_token',
            'created_at',
            'updated_at',
            'first_name',
            'middle_name',
            'last_name',
            'gender',
            'birth_date',
            'address',
            'phone',
            'mobile',
            'notes',
            'profile_image',
            'last_login',
            'last_logout',
        ],
    ]) ?>

</div>
