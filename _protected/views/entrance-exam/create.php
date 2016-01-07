<?php
use kartik\widgets\Typeahead;
/* @var $this yii\web\View */
/* @var $model app\models\EntranceExamForm */

$this->title = 'New';
$this->params['breadcrumbs'][] = ['label' => 'Entrance Exam', 'url' => ['index']];
?>
<div class="entrance-exam-form-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
