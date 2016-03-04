<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AssignedForm */

$this->title = 'Create Assigned Form';
$this->params['breadcrumbs'][] = ['label' => 'Assigned Forms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="assigned-form-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
