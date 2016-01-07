<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Message */

$this->title = 'New Message';
$this->params['breadcrumbs'][] = ['label' => 'Messages', 'url' => ['/messages']];
?>
<div class="message-create">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
