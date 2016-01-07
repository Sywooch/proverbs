<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ProfileForm */

$this->title = ucfirst($model->username);
$this->params['breadcrumbs'][] = ['label' => 'Profile', 'url' => ['index']];
?>
<div class="profile-form-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>