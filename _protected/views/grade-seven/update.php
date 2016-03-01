<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\GradeSevenForm */

$this->title = 'Update Grade Seven Form: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Grade Seven Forms', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="grade-seven-form-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
