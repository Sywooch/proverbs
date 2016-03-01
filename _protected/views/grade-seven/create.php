<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\GradeSevenForm */

$this->title = 'Create Grade Seven Form';
$this->params['breadcrumbs'][] = ['label' => 'Grade Seven Forms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="grade-seven-form-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
