<?php

use yii\helpers\Html;

$this->title = 'Update';
$this->params['breadcrumbs'][] = ['label' => 'Enroll', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
?>
<div class="enrolled-form-update">
    <?= $this->render('_form', [
        'model' => $model,
        'student' => $student
    ]) ?>

</div>