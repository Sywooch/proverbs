<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ClassAdviserForm */

$this->title = 'Create Class Adviser Form';
$this->params['breadcrumbs'][] = ['label' => 'Class Adviser Forms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="class-adviser-form-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
