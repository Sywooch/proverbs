<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\GradeOneForm */

$this->title = 'Create Grade';
?>
<div class="grade-one-form-create">
    <?= $this->render('_form', [
        'model' => $model,
        'enrolled' => $enrolled,
        'exist' => $exist
    ]) ?>
</div>
