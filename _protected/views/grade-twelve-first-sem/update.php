<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\GradeTwelveFirstSemForm */

$this->title = 'Update Grade Twelve First Sem Form: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Grade Twelve First Sem Forms', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="grade-twelve-first-sem-form-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
