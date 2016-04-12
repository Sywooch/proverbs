<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\EnrolledForm */

$this->title = 'New';
$this->params['breadcrumbs'][] = ['label' => 'Enroll', 'url' => ['index']];
?>
<div class="enrollment-form">
    <?= $this->render('_form-express', [
        'model' => $model,
        'student' => $student
    ]) ?>
</div>