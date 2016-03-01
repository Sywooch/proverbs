<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ClassAdviserForm */

$this->title = 'Update';
$this->params['breadcrumbs'][] = ['label' => 'Class Adviser Forms', 'url' => ['index']];
?>
<div class="class-adviser-form-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
