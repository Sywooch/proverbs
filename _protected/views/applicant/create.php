<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ApplicantForm */

$this->title = 'New Applicant';
$this->params['breadcrumbs'][] = ['label' => 'Applicant', 'url' => ['index']];
?>
<div class="applicant-form-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
