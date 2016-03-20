<?php

use yii\helpers\Html;
use yii\widgets\DetailView;


/* @var $this yii\web\View */
/* @var $model app\models\AssessmentForm */

$this->title = 'Create Assessment Form';
$this->params['breadcrumbs'][] = ['label' => 'Assessment Forms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="assessment-form-create">
	<h1><?= $student->id . ' ' . $student->last_name . ', ' . $student->first_name . ' ' . $student->middle_name ?></h1>

    <?= $this->render('_form-express', [
        'model' => $model,
        'tid' => $tid,
        'array' => $array,
    ]) ?>

</div>
