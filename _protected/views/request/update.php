<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DataRequest */

$this->title = 'Update Data Request: ' . $model->id;
?>
<div class="data-request-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
