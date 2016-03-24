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
    <div class="pva-form">
        <div class="pva-form-wrap">
            <div class="pva-form-login">
                <div class="panel panel-default form-login">
                    <div class="panel-body">
                        <div id="user-check-img-wrap">
                            <img id="user-check-img" class="animated2" src="<?= Yii::$app->request->baseUrl . '/themes/proverbs/images/user-default.png'?>" alt="user">
                        </div>
                        <p></p>
                        <span id="span-login-nav"><i id="back" class="fa fa-arrow-left fa-one-point-five i-back-btn invisible slide-in-right"></i></span>
                        <p></p>
                        <div id="check-email">
                            <div id="slide-form">
                                <div id="slide-mail" class="animated">
                                    <div class="row" style="margin: 0; padding: 0;">
                                        <div class="mail">
                                            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                                            <?php if ($model->scenario === 'lwe'): ?>
                                                <?= $form->field($model, 'email',['inputTemplate' => '{input}','inputOptions' => ['id' => 'input-mail-check', 'class' => 'form-control pva-border', 'placeholder' => 'Email']])->label(false) ?>     
                                            <?php else: ?>
                                            <?= $form->field($model, 'username',['inputTemplate' => '{input}','inputOptions' => ['class' => 'form-control pva-border', 'placeholder' => 'Username']])->label(false) ?>
                                            <?php endif ?>
                                            <p></p>
                                            <button type="button" href="#" id="btn-mail-check" class="btn btn-primary btn-block pva-border" style="height: 46px; background: #337AB7;">NEXT</button>
                                            <p></p>
                                        </div>
                                        <div class="pwd">
                                                <?= $form->field($model, 'password',['inputTemplate' => '{input}','inputOptions' => ['class' => 'form-control pva-border', 'placeholder' => 'Password']])->passwordInput()->label(false) ?>
                                                <div class="form-group"><?= Html::submitButton(Yii::t('app', 'LOGIN'), ['id' => 'btn-login-submit', 'class' => 'btn btn-primary btn-block pva-border', 'name' => 'login-button', 'style' => 'background: #337AB7; min-height: 46px;', 'disabled'=> 'disabled']) ?></div>
                                                <?= $form->field($model, 'rememberMe')->checkbox(['id' => 'remember-checkbox' ,'class' => ''])->label() ?>
                                            <?php ActiveForm::end(); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p id="msg-mail-check" style="color: white; font-size: 16px;"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php

if(Yii::$app->request->url === '/proverbs/site/login'){

if(!empty($model->errors)){
    $msg = $model->errors['password'][0];
    $this->registerJs("$('#msg-mail-check').html('" . $msg . "');");
}

$mailcheck = <<< JS
    $(document).ready(function(){
        $('.help-block.help-block-error').remove();

        var btn = $('#btn-mail-check');
        var msg = $('#msg-mail-check');
        var email = $('#input-mail-check');
        var fmail = $('#loginform-email');
        var back = $('#back');
        var img = $('#user-check-img');
        var sb = false;

        function slideLeft(){
            $('#slide-form').attr('style', 'left: -330px;');
            $('#btn-login-submit').removeAttr('disabled');

            back.removeClass('invisible').removeClass('slide-in-right').addClass('slide-in-left');
            back.removeClass('fa-arrow-right').addClass('fa-arrow-left');
        }

        function reset(){
            $('#msg-mail-check').html('');
            img.removeClass('grow');
        }

        function slideRight(){
            $('#slide-form').attr('style', 'left: 0;');
            $('#btn-login-submit').attr('disabled','disabled');

            back.addClass('invisible').removeClass('slide-in-left').addClass('slide-in-right');
            back.removeClass('fa-arrow-left').addClass('fa-arrow-right');
        }

        function showBackButton(){
            $('#back').removeClass('invisible').removeClass('slide-in-left');
        }

        function changeImg(data){
            img.removeAttr('src').attr('src', data);
        }

        function changeImgBg(data){
            if(data){
                img.addClass('grow');
            } else {
                img.removeClass('grow');
            }
        }

        function hi(data){
            msg.html('Hi ' + data + '!');
        }

        back.click(function(){
            if(!sb){
                slideLeft();
                sb = true;
            } else{
                slideRight();
                sb = false;
            }
        });

        btn.click(function(){
            reset();
            $.post('mail-check?email=' + email.val(), function(data){
                if(data.code === 0){
                    changeImgBg(false);
                    $('#msg-mail-check').html('Please enter your email address.');
                } else if(data.code === 404) {
                    changeImgBg(false);
                    msg.html('Email address could not be found.');
                } else if(data.code === 500) {
                    changeImgBg(false);
                    msg.html('Oops! Not a valid email address.');
                } else if(data.code === 200){
                    hi(data.username);
                    changeImgBg(true);
                    changeImg(data.foto);
                    back.click();
                    console.log('');
                }
            });
        });
    });
JS;
$this->registerJs($mailcheck);
}
?>