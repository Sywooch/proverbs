<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\GradeOneForm */

$this->title = 'Create Grade One Form';
$this->params['breadcrumbs'][] = ['label' => 'Grade One Forms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="grade-one-form-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
