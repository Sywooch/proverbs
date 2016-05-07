<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Payment */
$this->title = 'Update';
?>
<div class="payment-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
