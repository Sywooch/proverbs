<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AssignedForm */

$this->title = 'Update Assigned Form: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Assigned Forms', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="assigned-form-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
