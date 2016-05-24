<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Section */

$this->title = $model->section_name;
?>
<div class="section-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
