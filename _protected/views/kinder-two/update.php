<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\KinderOneForm */

$this->title = 'Update Kinder One Form: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Kinder One Forms', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="kinder-one-form-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
