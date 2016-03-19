<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Tuition */

$this->title = 'Create Tuition';
$this->params['breadcrumbs'][] = ['label' => 'Tuitions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tuition-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
