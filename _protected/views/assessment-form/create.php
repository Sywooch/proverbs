<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AssessmentForm */

$this->title = 'Create Assessment Form';
$this->params['breadcrumbs'][] = ['label' => 'Assessment Forms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="assessment-form-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
