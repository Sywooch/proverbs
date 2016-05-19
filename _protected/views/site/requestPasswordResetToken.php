<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \app\models\PasswordResetRequestForm */

$this->title = Yii::t('app', 'Request Password Reset');
?>
<div class="pva-login-mask">
    <a id="btn-login" href="login" class="btn btn-primary btn-lg rounded-edge">LOGIN</a>
    <div class="pva-form">
        <div class="pva-form-wrap">
            <div class="pva-form-login">
                <div class="panel panel-default form-login">
                    <div class="panel-body">
                        <div class="ui divided items" style="text-align: center; margin: auto;">
                            <div class="item">
                                <div class="ui small image proverbs" style="text-align: center; margin: auto;">
                                    <?= Html::img(Yii::$app->params['logo'], ['id' => 'proverbs-logo']) ?>
                                </div>
                            </div>
                        </div>
                        <span id="span-login-nav"><i id="back" class="fa fa-arrow-left fa-one-point-five i-back-btn invisible slide-in-right"></i></span>
                        <p></p>
                        <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>
                            <?= $form->field($model, 'email',['inputTemplate' => '{input}','inputOptions' => ['id' => 'input-mail-check', 'class' => 'form-control pva-border', 'placeholder' => 'Please fill out your email.']])->label(false) ?>
                            <div class="slide-btn" style="margin-top: -10px;">
                                <?= Html::submitButton(Yii::t('app', 'SEND'), ['class' => 'btn btn-primary btn-block pva-border', 'style' => 'height: 46px; background: #337AB7; border: 0; margin: 0;']) ?>
                            </div>
                            <div style="min-height: 90px;"></div>
                            <p style="color: white;">**A link to reset password will be sent to your email.</p>
                        <?php ActiveForm::end(); ?>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
