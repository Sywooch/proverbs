<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AssignedForm */

$this->title = 'Create Assigned Form';
$this->params['breadcrumbs'][] = ['label' => 'Assigned Forms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="assigned-form-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
