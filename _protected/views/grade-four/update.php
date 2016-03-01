<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\GradeFourForm */

$this->title = 'Update Grade Four Form: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Grade Four Forms', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="grade-four-form-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
