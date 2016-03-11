<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\LearningArea */

$this->title = 'Update Learning Area: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Learning Areas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id, 'subject_id' => $model->subject_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="learning-area-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
