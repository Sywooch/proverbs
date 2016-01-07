<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ProfileForm */

$this->title = 'Create Profile Form';
$this->params['breadcrumbs'][] = ['label' => 'Profile Forms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-form-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>