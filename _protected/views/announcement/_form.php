<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Announcement */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="announcement-form">

    <?php $form = ActiveForm::begin(); ?>
	<div class="row">
        <div class="container form-input-wrapper">
    		<div class="col-lg-6 col-md-6 col-sm-12">
                <?= $form->field($model, 'content', ['inputTemplate' => '{input}','inputOptions' => ['placeholder' => 'Write something']])->label(false)->textarea(['maxlength' => true]) ?>
            </div>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Cancel'), ['/announcement'], ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
