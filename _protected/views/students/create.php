<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ApplicantForm */

$this->title = 'New Student';
$this->params['breadcrumbs'][] = ['label' => 'Students', 'url' => ['index']];
?>
<div class="student-form-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
