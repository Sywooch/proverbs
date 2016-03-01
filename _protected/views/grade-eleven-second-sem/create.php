<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\GradeElevenSecondSemForm */

$this->title = 'Create Grade Eleven Second Sem Form';
$this->params['breadcrumbs'][] = ['label' => 'Grade Eleven Second Sem Forms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="grade-eleven-second-sem-form-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
