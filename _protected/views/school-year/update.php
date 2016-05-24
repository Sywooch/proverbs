<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SchoolYear */

$this->title = $model->id;
?>
<div class="school-year-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
