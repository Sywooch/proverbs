<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\LearningArea */

$this->title = 'Create Learning Area';
$this->params['breadcrumbs'][] = ['label' => 'Learning Areas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="learning-area-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
