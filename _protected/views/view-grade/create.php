<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\NurseryForm */

$this->title = 'Create Nursery Form';
$this->params['breadcrumbs'][] = ['label' => 'Nursery Forms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nursery-form-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
