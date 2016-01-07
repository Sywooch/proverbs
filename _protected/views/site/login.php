<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \app\models\LoginForm */

$this->title = Yii::t('app', 'Login');
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pva-login-mask">
    <div class="pva-login">
        <div class="pva-form-wrap">
            <div class="pva-form">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"></div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="panel panel-default form-login">
                    <div class="panel-body">
                        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                        
                        <?php if ($model->scenario === 'lwe'): ?>
                            <?= $form->field($model, 'email',['inputTemplate' => '<div class="input-group"><span class="input-group-addon"><i class="fa fa-envelope-o"></i></span></span>{input}</div>','inputOptions' => ['placeholder' => 'Email']])->label(false) ?>     
                        <?php else: ?>

                        <?= $form->field($model, 'username',['inputTemplate' => '<div class="input-group"><span class="input-group-addon"><i class="fa fa-envelope-o"></i></span></span>{input}</div>','inputOptions' => ['placeholder' => 'Email']])->label(false) ?>
                        <?php endif ?>

                        <?= $form->field($model, 'password',['inputTemplate' => '<div class="input-group"><span class="input-group-addon"><i class="fa fa-asterisk"></i></span>{input}</div>','inputOptions' => ['placeholder' => 'Password']])->passwordInput()->label(false) ?>

                        <div class="form-group">
                        <?= Html::submitButton(Yii::t('app', 'LOGIN'), ['class' => 'btn btn-primary btn-lg btn-block', 'name' => 'login-button']) ?>
                        </div>
                        
                        <?= $form->field($model, 'rememberMe')->checkbox(['style' => 'margin-left: -20px;']) ?>
                        <div class="pull-left" style="color:white;margin:1em 0">
                            <?= Html::a(Yii::t('app', 'Signup'), ['site/signup']) ?>
                        </div>
                        <div class="pull-right" style="color:white;margin:1em 0">
                            <?= Html::a(Yii::t('app', 'Forgot password?'), ['site/request-password-reset']) ?>
                        </div>
                        <?php ActiveForm::end(); ?>  
                    </div>
                    </div>
                    <div class="text-centered"><span class="pva-form-terms">By logging in, you agree to PVAES <a href="<?php Yii::$app->request->baseUrl;?>about#terms">Terms of Use</a> and <a href="<?php Yii::$app->request->baseUrl;?>about#privacy">Privacy Policy</a></span></div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"></div>
            </div>
        </div>
    </div>
</div>