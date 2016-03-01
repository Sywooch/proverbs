<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ClassAdviserForm */

$this->title = $model->teacher_id;
$this->params['breadcrumbs'][] = ['label' => 'Class Adviser Forms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="class-adviser-form-view">
    <p>
        <?= Html::a('Update', ['update', 'teacher_id' => $model->teacher_id, 'grade_level_id' => $model->grade_level_id, 'sy_id' => $model->sy_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'teacher_id' => $model->teacher_id, 'grade_level_id' => $model->grade_level_id, 'sy_id' => $model->sy_id], [
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
            [
                'attribute' => 'teacher_id',
                'value' => $model->teacher->last_name . ', ' . $model->teacher->first_name . ' ' . $model->teacher->middle_name,
            ],
            [
                'attribute' => 'grade_level_id',
                'value' => $model->gradeLevel->name,
            ],
            'sy.sy',
        ],
    ]) ?>

</div>
