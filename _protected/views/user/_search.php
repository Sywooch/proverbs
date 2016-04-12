<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UserSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-search">
    <h4>Search</h4>
    <hr class="hr-full-width">
    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
    <a class="btn btn-warning btn-block" role="button" data-toggle="collapse" href="#user-profile-more" aria-expanded="false" aria-controls="user-profile-more" aria-expanded="false" aria-controls="user-profile-more">More Search Filters</a>
    <p></p>
    <?= $form->field($model, 'username', ['inputTemplate' => '<div class="input-div-wrap"><label><strong>Username</strong></label>{input}</div>','inputOptions' => ['class' => 'form-control']])->label(false) ?>
    <div class="collapse" id="user-profile-more">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">    
                <?= $form->field($model, 'status', ['inputTemplate' => '<div class="input-div-wrap"><label><strong>Status</strong></label>{input}</div>','inputOptions' => ['class' => 'form-control pva-form-control']])->dropDownList($model->statusArray)->label(false) ?>
                <?= $form->field($model, 'email', ['inputTemplate' => '<div class="input-div-wrap"><label><strong>Email</strong></label>{input}</div>','inputOptions' => ['class' => 'form-control pva-form-control']])->label(false) ?>
                <?= $form->field($model, 'item_name', ['inputTemplate' => '<div class="input-div-wrap"><label><strong>Role</strong></label>{input}</div>','inputOptions' => ['class' => 'form-control pva-form-control']])->dropDownList($model->rolesArray)->label(false) ?>
            </div>
        </div>
    </div>
    <p></p>
    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary btn-block']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default btn-block']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>