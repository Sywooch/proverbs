<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\KinderOneForm */

$this->title = 'Create Kinder One Form';
$this->params['breadcrumbs'][] = ['label' => 'Kinder One Forms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kinder-one-form-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
