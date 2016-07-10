<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\DataRequest */

$this->title = 'Create Data Request';
$this->params['breadcrumbs'][] = ['label' => 'Data Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-request-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
