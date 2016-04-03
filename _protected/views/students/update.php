<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ApplicantForm */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Student', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-form-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>