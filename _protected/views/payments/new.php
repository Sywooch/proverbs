<?php
$this->title = 'New Payment';
$this->params['breadcrumbs'][] = ['label' => 'Payments', 'url' => ['/payments']];
?>
<div class="payment-create">
    <div class="row">
        <div class="container form-input-wrapper">
            <div class="col-lg-4 col-md-4 col-sm-12">
            	<p></p>
            	<span class="express-form-student"><?= $student->id . ' ' . $student->last_name  . ', ' . $student->first_name . ' ' . $student->middle_name ;?></span>
            	<p></p>
            </div>
        </div>
    </div>
    <p></p>
    <?= $this->render('_form-express', [
        'model' => $model,
    ]) ?>

</div>