<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ProfileForm */

$this->title = ucfirst($model->username) . '\'s Profile';
$this->params['breadcrumbs'][] = ['label' => 'Profile', 'url' => ['index']];
?>
<div class="profile-form-view">

    <h1><?= Html::encode(ucfirst($model->username)) ?></h1>
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
            //'id',
            'username',
            'email:email',
            'first_name',
            'middle_name',
            'last_name',
            'gender',
            'birth_date',
            'address',
            'phone',
            'mobile',
            'notes',
        ],
    ]) ?>

</div>