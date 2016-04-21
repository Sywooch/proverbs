<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ProfileForm */

$this->title = ucfirst($model->username);
$this->params['breadcrumbs'][] = ['label' => 'Profile', 'url' => ['index']];
?>
<div class="profile-form-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>