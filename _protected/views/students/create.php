<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ApplicantForm */

$this->title = 'New';
$this->params['breadcrumbs'][] = ['label' => 'Students', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-form-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
