<?php
$this->title = 'New Payment';
$this->params['breadcrumbs'][] = ['label' => 'Payments', 'url' => ['/payments']];
?>
<?= $this->render('_form-express', [
    'model' => $model,
    'student' => $student,
    'assessment' => $assessment
]) ?>