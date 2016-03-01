<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\NurseryForm */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Nursery Forms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nursery-form-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Cancel'), ['/nursery'], ['class' => 'btn btn-default']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'enrolled_id',
            'grading_period',
            'core_value_1',
            'core_value_2',
            'core_value_3',
            'core_value_4',
            'subject_1',
            'subject_2',
            'subject_3',
            'subject_4',
            'subject_5',
        ],
    ]) ?>
</div>
<br/>
<p>
    <?= Html::a('Delete', ['delete', 'id' => $model->id], [
    'class' => 'pull-right btn btn-danger',
    'data' => [
        'confirm' => 'Are you sure you want to delete this item?',
        'method' => 'post',
    ],
]) ?>

    <?= Html::a('Test', ['test', 'id' => $model->id , 'grading_period' => 2], [
    'class' => 'pull-right btn btn-info',
    'style' => 'margin: 0 5px;',
    'data' => [
        'confirm' => 'Are you sure you want to update this item?',
        'method' => 'post',
        'enablePushState' => 'false',
    ],
]) ?>
</p>
