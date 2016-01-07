<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Payment */

$this->title = 'New Payment';
$this->params['breadcrumbs'][] = ['label' => 'Payments', 'url' => ['index']];
?>
<div class="payment-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
