<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\NurseryForm */

$this->title = 'Update Nursery Form: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Nursery Forms', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="nursery-form-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
