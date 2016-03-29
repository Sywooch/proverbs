<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AssessmentForm */

$this->title = 'Assessment Form #' . $model->id . ' - Update';
$this->params['breadcrumbs'][] = ['label' => 'Assessment Forms', 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
// $this->params['breadcrumbs'][] = 'Update';
?>
<div class="assessment-form-update">
	<h1><?= $student->id . ', ' . $student->last_name . ' ' . $student->first_name . ' ' . $student->middle_name ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
        'tuition' => $tuition,
        'tid' => $tid,
        'array' => $array,
        'student' => $student,
        'sbm' => $sbm,
        'sbd' => $sbd,
    ]) ?>

</div>
