<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\GradeFourForm */

$this->title = 'Create Grade Four Form';
$this->params['breadcrumbs'][] = ['label' => 'Grade Four Forms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="grade-four-form-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
