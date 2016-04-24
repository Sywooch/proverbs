<?php

use yii\helpers\Html;
use app\models\StudentForm;
/* @var $this yii\web\View */
/* @var $model app\models\EnrolledForm */
?>
<div class="enrollment-form">
    <?= $this->render('_form', [
	    'model' => $model,
	]) ?>
</div>