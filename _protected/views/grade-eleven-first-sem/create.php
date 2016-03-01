<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\GradeElevenFirstSemForm */

$this->title = 'Create Grade Eleven First Sem Form';
$this->params['breadcrumbs'][] = ['label' => 'Grade Eleven First Sem Forms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="grade-eleven-first-sem-form-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
