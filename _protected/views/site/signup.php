<?php
use nenad\passwordStrength\PasswordInput;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \app\models\SignupForm */

$this->title = Yii::t('app', 'Signup');
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sky">
    <div class="moon"></div>
    <div class="clouds_one"></div>
    <div class="clouds_two"></div>
    <div class="clouds_three"></div>
</div>
<div class="pva-login-mask">
    <div class="pva-login">
        <div class="pva-form-wrap">
            <div class="pva-form">
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12"></div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="panel-heading login-form-heading">
                        <h2>Sign In</h2>
                    </div>
                    <div class="panel panel-default form-login">
                        <div class="panel-body">
                            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                            <?= $form->field($model, 'username',['inputTemplate' => '<div class="input-group"><span class="input-group-addon"><i class="fa fa-user"></i></span></span>{input}</div>','inputOptions' => ['placeholder' => 'Username']])->label(false) ?>
                            <?= $form->field($model, 'email',['inputTemplate' => '<div class="input-group"><span class="input-group-addon"><i class="fa fa-envelope-o"></i></span></span>{input}</div>','inputOptions' => ['placeholder' => 'Email']])->label(false) ?>
                            <?= $form->field($model, 'password',['inputTemplate' => '<div class="input-group"><span class="input-group-addon"><i class="fa fa-asterisk"></i></span></span>{input}</div>'])->label(false)->widget(PasswordInput::classname(), [])?>

                            <?= $form->field($model, 'verifyCode')->label('Verify Code:', ['style' => 'color: white;'])->widget(Captcha::className(), [
                                'template' => '<div class="row"><div class="col-lg-3 col-md-3 col-sm-12 text-centered" style="margin-bottom: 15px;">{image}</div><div class="col-lg-1 col-md-12 col-sm-12"></div><div class="col-lg-8 col-md-8 col-sm-12">{input}</div></div>',
                            ]) ?>

                            <div class="form-group">
                                <?= Html::submitButton(Yii::t('app', 'SIGN UP'), ['class' => 'btn btn-primary btn-lg btn-block', 'name' => 'signup-button']) ?>
                            </div>

                            <?php ActiveForm::end(); ?>

                            <?php if ($model->scenario === 'rna'): ?>
                                <div class="text-centered" style="color: white;margin:1em 0;font-size:1em;">
                                    <i>* <?= Yii::t('app', 'Activation link will be sent to your email account.') ?></i>
                                </div>
                            <?php endif ?>  
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-centered" style="color:white;margin:1em 0">
                            <span class="pva-form-registered">Already registered? <?= Html::a(Yii::t('app', 'Login'), ['site/login']) ?></span>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12"></div> 
            </div>
        </div>
    </div>
</div>