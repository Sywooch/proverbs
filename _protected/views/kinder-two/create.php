<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\KinderOneForm */

$this->title = 'Create Kinder Two';
$this->params['breadcrumbs'][] = ['label' => 'Kinder Two Forms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kinder-two-form-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
