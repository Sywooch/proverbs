<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AssessmentForm */

$this->title = 'Update Assessment Form: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Assessment Forms', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="assessment-form-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'tuition' => $tuition,
        'tid' => $tid,
        'array' => $array,
        'student' => $student
    ]) ?>

</div>
