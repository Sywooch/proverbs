<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\GradeTwelveFirstSemForm */

$this->title = 'Create Grade Twelve First Sem Form';
$this->params['breadcrumbs'][] = ['label' => 'Grade Twelve First Sem Forms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="grade-twelve-first-sem-form-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
