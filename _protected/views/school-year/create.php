<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SchoolYear */

$this->title = 'Create School Year';
$this->params['breadcrumbs'][] = ['label' => 'School Years', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="school-year-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
