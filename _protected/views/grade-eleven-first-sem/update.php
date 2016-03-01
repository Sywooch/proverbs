<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\GradeElevenFirstSemForm */

$this->title = 'Update Grade Eleven First Sem Form: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Grade Eleven First Sem Forms', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="grade-eleven-first-sem-form-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
