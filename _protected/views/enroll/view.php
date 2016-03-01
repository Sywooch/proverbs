<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\EnrolledForm */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Enroll', 'url' => ['index']];
?>
<div class="enrolled-form-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Payment', ['/payments/new', 'id' => $model->student_id], ['class' => 'btn btn-info']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'student_id',
            'student.last_name',
            'student.middle_name',
            'student.first_name',
            [
                'attribute' => 'grade_level_id',
                'value' => $model->gradeLevel->name,
            ],
            [
                'attribute' => 'enrollment_status',
                'value' => $model->getEnrollmentStatus($model->enrollment_status)
            ],
            'sy.sy',
            'created_at:date',
            [
                'attribute' => 'updated_at',
                'value' => $model->getUpdatedAt($model->updated_at)
            ],
        ],
    ]) ?>
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
</div>
