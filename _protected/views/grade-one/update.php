<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\GradeOneForm */

$this->title = 'Update Grade One Form: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Grade One Forms', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="grade-one-form-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
