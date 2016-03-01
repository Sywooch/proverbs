<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\GradeFourForm */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Grade Four Forms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="grade-four-form-view">
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'grade_protection',
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
            'subject_6',
            'subject_7',
            'subject_8',
        ],
    ]) ?>

</div>
