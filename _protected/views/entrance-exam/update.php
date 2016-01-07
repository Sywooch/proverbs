<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\EntranceExamForm */

$this->title = 'Update Entrance Exam Form: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Entrance Exam Forms', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="entrance-exam-form-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
