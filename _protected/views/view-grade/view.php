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
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Cancel'), ['/nursery'], ['class' => 'btn btn-default']) ?>
    </p>
    <p>
        <?php
            if($model->enrolled->grade_level_id === 1){
                echo DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id',
                        'enrolled_id',
                        'grading_period',
                        'subject_1',
                        'subject_2',
                        'subject_3',
                        'subject_4',
                        'subject_5',
                        'core_value_1',
                        'core_value_2',
                        'core_value_3',
                        'core_value_4',
                        ],
                    ]);
            } elseif($model->enrolled->grade_level_id === 2){
                echo DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id',
                        'enrolled_id',
                        'grading_period',
                        'subject_1',
                        'subject_2',
                        'subject_3',
                        'subject_4',
                        'subject_5',
                        'core_value_1',
                        'core_value_2',
                        'core_value_3',
                        'core_value_4',
                        ],
                ]);
            } elseif($model->enrolled->grade_level_id === 3){
                echo DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id',
                        'enrolled_id',
                        'grading_period',
                        'subject_1',
                        'subject_2',
                        'subject_3',
                        'subject_4',
                        'subject_5',
                        'core_value_1',
                        'core_value_2',
                        'core_value_3',
                        'core_value_4',
                        ],
                ]);
            } elseif($model->enrolled->grade_level_id === 4){
                echo DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id',
                        'enrolled_id',
                        'grading_period',
                        'subject_1',
                        'subject_2',
                        'subject_3',
                        'subject_4',
                        'subject_5',
                        'subject_6',
                        'core_value_1',
                        'core_value_2',
                        'core_value_3',
                        'core_value_4',
                        ],
                ]);
            } elseif($model->enrolled->grade_level_id === 10){
                echo DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id',
                        'enrolled_id',
                        'grading_period',
                        'subject_1',
                        'subject_2',
                        'subject_3',
                        'subject_4',
                        'subject_5',
                        'subject_6',
                        'subject_7',
                        'subject_8',
                        'core_value_1',
                        'core_value_2',
                        'core_value_3',
                        'core_value_4',
                        ],
                ]);
            } elseif($model->enrolled->grade_level_id === 20){
                echo DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id',
                        'enrolled_id',
                        'grading_period',
                        'subject_1',
                        'subject_2',
                        'subject_3',
                        'subject_4',
                        'subject_5',
                        'subject_6',
                        'subject_7',
                        'subject_8',
                        'core_value_1',
                        'core_value_2',
                        'core_value_3',
                        'core_value_4',
                        ],
                ]);
            } elseif($model->enrolled->grade_level_id === 20){
                echo DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id',
                        'enrolled_id',
                        'grading_period',
                        'subject_1',
                        'subject_2',
                        'subject_3',
                        'subject_4',
                        'subject_5',
                        'subject_6',
                        'subject_7',
                        'subject_8',
                        'core_value_1',
                        'core_value_2',
                        'core_value_3',
                        'core_value_4',
                        ],
                ]);
            } elseif($model->enrolled->grade_level_id === 40){
                echo DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id',
                        'enrolled_id',
                        'grading_period',
                        'subject_1',
                        'subject_2',
                        'subject_3',
                        'subject_4',
                        'subject_5',
                        'subject_6',
                        'subject_7',
                        'subject_8',
                        'core_value_1',
                        'core_value_2',
                        'core_value_3',
                        'core_value_4',
                        ],
                ]);
            } elseif($model->enrolled->grade_level_id === 50){
                echo DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id',
                        'enrolled_id',
                        'grading_period',
                        'subject_1',
                        'subject_2',
                        'subject_3',
                        'subject_4',
                        'subject_5',
                        'subject_6',
                        'subject_7',
                        'subject_8',
                        'core_value_1',
                        'core_value_2',
                        'core_value_3',
                        'core_value_4',
                        ],
                ]);
            } elseif($model->enrolled->grade_level_id === 60){
                echo DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id',
                        'enrolled_id',
                        'grading_period',
                        'subject_1',
                        'subject_2',
                        'subject_3',
                        'subject_4',
                        'subject_5',
                        'subject_6',
                        'subject_7',
                        'subject_8',
                        'core_value_1',
                        'core_value_2',
                        'core_value_3',
                        'core_value_4',
                        ],
                ]);
            } elseif($model->enrolled->grade_level_id === 70){
                echo DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id',
                        'enrolled_id',
                        'grading_period',
                        'subject_1',
                        'subject_2',
                        'subject_3',
                        'subject_4',
                        'subject_5',
                        'subject_6',
                        'subject_7',
                        'subject_8',
                        'core_value_1',
                        'core_value_2',
                        'core_value_3',
                        'core_value_4',
                        ],
                ]);
            } elseif($model->enrolled->grade_level_id === 80){
                echo DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id',
                        'enrolled_id',
                        'grading_period',
                        'subject_1',
                        'subject_2',
                        'subject_3',
                        'subject_4',
                        'subject_5',
                        'subject_6',
                        'subject_7',
                        'subject_8',
                        'core_value_1',
                        'core_value_2',
                        'core_value_3',
                        'core_value_4',
                        ],
                ]);
            } elseif($model->enrolled->grade_level_id === 80){
                echo DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id',
                        'enrolled_id',
                        'grading_period',
                        'subject_1',
                        'subject_2',
                        'subject_3',
                        'subject_4',
                        'subject_5',
                        'subject_6',
                        'subject_7',
                        'subject_8',
                        'core_value_1',
                        'core_value_2',
                        'core_value_3',
                        'core_value_4',
                        ],
                ]);
            } elseif($model->enrolled->grade_level_id === 90){
                echo DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id',
                        'enrolled_id',
                        'grading_period',
                        'subject_1',
                        'subject_2',
                        'subject_3',
                        'subject_4',
                        'subject_5',
                        'subject_6',
                        'subject_7',
                        'subject_8',
                        'core_value_1',
                        'core_value_2',
                        'core_value_3',
                        'core_value_4',
                        ],
                ]);
            } elseif($model->enrolled->grade_level_id === 100){
                echo DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id',
                        'enrolled_id',
                        'grading_period',
                        'subject_1',
                        'subject_2',
                        'subject_3',
                        'subject_4',
                        'subject_5',
                        'subject_6',
                        'subject_7',
                        'subject_8',
                        'core_value_1',
                        'core_value_2',
                        'core_value_3',
                        'core_value_4',
                        ],
                ]);
            } elseif($model->enrolled->grade_level_id === 110){
                echo DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id',
                        'enrolled_id',
                        'grading_period',
                        'subject_1',
                        'subject_2',
                        'subject_3',
                        'subject_4',
                        'subject_5',
                        'subject_6',
                        'subject_7',
                        'subject_8',
                        'subject_9',
                        'subject_10',
                        'core_value_1',
                        'core_value_2',
                        'core_value_3',
                        'core_value_4',
                        ],
                ]);
            } elseif($model->enrolled->grade_level_id === 111){
                echo DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id',
                        'enrolled_id',
                        'grading_period',
                        'subject_1',
                        'subject_2',
                        'subject_3',
                        'subject_4',
                        'subject_5',
                        'subject_6',
                        'subject_7',
                        'subject_8',
                        'subject_9',
                        'subject_10',
                        'core_value_1',
                        'core_value_2',
                        'core_value_3',
                        'core_value_4',
                        ],
                ]);
            } elseif($model->enrolled->grade_level_id === 120){
                echo DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id',
                        'enrolled_id',
                        'grading_period',
                        'subject_1',
                        'subject_2',
                        'subject_3',
                        'subject_4',
                        'subject_5',
                        'subject_6',
                        'subject_7',
                        'subject_8',
                        'subject_9',
                        'subject_10',
                        'core_value_1',
                        'core_value_2',
                        'core_value_3',
                        'core_value_4',
                        ],
                ]);
            } elseif($model->enrolled->grade_level_id === 121){
                echo DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id',
                        'enrolled_id',
                        'grading_period',
                        'subject_1',
                        'subject_2',
                        'subject_3',
                        'subject_4',
                        'subject_5',
                        'subject_6',
                        'subject_7',
                        'subject_8',
                        'subject_9',
                        'subject_10',
                        'core_value_1',
                        'core_value_2',
                        'core_value_3',
                        'core_value_4',
                        ],
                ]);
            }
        ?>
    </p>
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
</p>
