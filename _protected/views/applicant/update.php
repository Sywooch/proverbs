<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ApplicantForm */

$this->title = $model->last_name . ', ' . $model->first_name . ' ' . $model->middle_name;
$this->params['breadcrumbs'][] = ['label' => 'Applicant', 'url' => ['index']];
?>
<div class="applicant-form-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
