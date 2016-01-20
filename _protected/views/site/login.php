<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \app\models\LoginForm */

$this->title = Yii::t('app', 'Login');
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sky">
    <div class="moon"></div>
    <div class="clouds_one"></div>
    <div class="clouds_two"></div>
    <div class="clouds_three"></div>
</div>
<div class="pva-login-mask">
    <div class="pva-form">
        <div class="pva-form-wrap">
            <div class="pva-form">
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12"></div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="panel panel-default form-login">
                    <div class="panel-heading login-form-heading">
                        <h2>Sign In</h2>
                    </div>
                    <p></p>
                    <div class="panel-body">
                        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                        
                        <?php if ($model->scenario === 'lwe'): ?>
                            <?= $form->field($model, 'email',['inputTemplate' => '<div class="input-group"><span class="input-group-addon"><i class="fa fa-envelope-o"></i></span></span>{input}</div>','inputOptions' => ['placeholder' => 'Email']])->label(false) ?>     
                        <?php else: ?>

                        <?= $form->field($model, 'username',['inputTemplate' => '<div class="input-group"><span class="input-group-addon"><i class="fa fa-envelope-o"></i></span></span>{input}</div>','inputOptions' => ['placeholder' => 'Email']])->label(false) ?>
                        <?php endif ?>

                        <?= $form->field($model, 'password',['inputTemplate' => '<div class="input-group"><span class="input-group-addon"><i class="fa fa-lock fa-group-addon-field"></i></span>{input}</div>','inputOptions' => ['placeholder' => 'Password']])->passwordInput()->label(false) ?>

                        <div class="form-group">
                        <?= Html::submitButton(Yii::t('app', 'LOGIN'), ['class' => 'btn btn-primary btn-lg btn-block', 'name' => 'login-button']) ?>
                        </div>
                        
                        <?= $form->field($model, 'rememberMe')->checkbox(['style' => 'margin-left: -20px;']) ?>
                        <div class="pull-left sign-up" style="color:white;margin:1em 0">
                            <?= Html::a(Yii::t('app', 'Signup'), ['site/signup']) ?>
                        </div>
                        <div class="pull-right forgot-password" style="color:white;margin:1em 0">
                            <?= Html::a(Yii::t('app', 'Forgot password?'), ['site/request-password-reset']) ?>
                        </div>
                        <?php ActiveForm::end(); ?>  
                    </div>
                    </div>
                    <div class="text-centered"><span class="pva-form-terms">By logging in, you agree to our <a href="<?php Yii::$app->request->baseUrl;?>about#terms">PVAES Terms of Use</a> and <a href="<?php Yii::$app->request->baseUrl;?>about#privacy">Privacy Policy</a></span></div>
                </div>
                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12"></div>
            </div>
        </div>
    </div>
</div>