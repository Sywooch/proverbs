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
    <a id="btn-signup" href="signup" class="btn btn-primary btn-lg rounded-edge">SIGN UP</a>
    <div class="pva-form">
        <div class="pva-form-wrap">
            <div class="pva-form-login">
                <div class="panel panel-default form-login">
                    <div class="panel-body">
                        <div id="user-check-img-wrap">
                            <img id="user-check-img" class="animated2" src="<?= Yii::$app->request->baseUrl . '/uploads/ui/user-default.png'?>" alt="user" data-img="false">
                        </div>
                        <p></p>
                        <span id="span-login-nav"><i id="back" class="fa fa-arrow-left fa-one-point-five i-back-btn invisible slide-in-right"></i></span>
                        <p></p>
                        <div id="check-email">
                            <div id="slide-form">
                                <div id="slide-mail" class="animated">
                                    <div id="slide-content" class="row" style="margin: 0; padding: 0;">
                                        <div class="mail">
                                            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                                            <?php if ($model->scenario === 'lwe'): ?>
                                                <?= $form->field($model, 'email',['inputTemplate' => '{input}','inputOptions' => ['id' => 'input-mail-check', 'class' => 'form-control pva-border', 'placeholder' => 'Email']])->label(false) ?>     
                                            <?php else: ?>
                                            <?= $form->field($model, 'username',['inputTemplate' => '{input}','inputOptions' => ['class' => 'form-control pva-border', 'placeholder' => 'Username']])->label(false) ?>
                                            <?php endif ?>
                                        </div>
                                        <div class="pwd">
                                            <?= $form->field($model, 'password',['inputTemplate' => '{input}','inputOptions' => ['class' => 'form-control pva-border hidden', 'placeholder' => 'Password']])->passwordInput()->label(false) ?>
                                        </div>
                                    </div>
                                </div>                                
                            </div>
                            <div class="slide-btn">
                                <button type="button" href="#" id="btn-mail-check" class="btn btn-primary btn-block pva-border" style="height: 46px; background: #337AB7; border: 0;">NEXT</button>
                            </div>
                            <div id="remember-checkbox-wrap" class="checkbox" style="right: -320px;">
                                <?= $form->field($model, 'rememberMe', ['inputTemplate' => '<div style="margin-top: 0;"><label style="padding: 0; color: white;">Stay Logged in</label><div class="pull-right">{input}</div></div>'])->checkbox($options = ['class' => 'js-switch pull-right', 'data-switchery' => true, 'value' => 0])->label(false) ?>
                            </div>
                        </div>
                        <?php ActiveForm::end(); ?>
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
    $u = new app\models\User;
    $query = $u::find()->where(['email' => $model->email])->all();

    if(!empty($query)){

        if(!empty($query[0]['profile_image']) || $query[0]['http://localhost/proverbs/themes/proverbs/images/user-default.pngle_image'] !== null){

            $foto = Yii::$app->request->baseUrl . '/uploads/profile-img/' . $query[0]['profile_image'];
            $this->registerJs("$('#msg-mail-check').html('" . $msg . "'); $('#user-check-img').attr('src','" . $foto . "'); $('#user-check-img').attr('data-img','true');");
        } else {

            $foto = Yii::$app->request->baseUrl .'/uploads/ui/user-blue.png';
            $this->registerJs("$('#msg-mail-check').html('" . $msg . "'); $('#user-check-img').attr('src','" . $foto . "'); $('#user-check-img').attr('data-img','false');");
        }
    }
}

$mailcheck = <<< JS
    $(document).ready(function(){
        $('.help-block.help-block-error').remove();

        var btn = $('#btn-mail-check');
        var msg = $('#msg-mail-check');
        var email = $('#input-mail-check');
        var fmail = $('#loginform-email');
        var back = $('#back');
        var imgWrap = $('#user-check-img-wrap');
        var img = $('#user-check-img');
        var pwd = $('#loginform-password');
        var chkbox = $('#remember-checkbox');
        var sb = false;

        function reset(){
            $('#msg-mail-check').html('');
            img.removeClass('grow');
        }

        function slideLeft(){
            $('#slide-form').attr('style', 'left: -330px;');
            $('#remember-checkbox-wrap').removeAttr('style').attr('style', 'right: 0;');
            back.removeClass('invisible').removeClass('slide-in-right').addClass('slide-in-left');
            back.removeClass('fa-arrow-right').addClass('fa-arrow-left');
            img.removeClass('shrink');
        }


        function slideRight(){
            $('#slide-form').attr('style', 'left: 0;');
            $('#remember-checkbox-wrap').removeAttr('style').attr('style', 'right: -320px;');
            back.addClass('invisible').removeClass('slide-in-left').addClass('slide-in-right');
            back.removeClass('fa-arrow-left').addClass('fa-arrow-right');
            img.addClass('shrink');
        }

        function showBackButton(){
            $('#back').removeClass('invisible').removeClass('slide-in-left');
        }

        function showPwdChkbox(){
            pwd.removeClass('hidden');
            chkbox.removeClass('hidden');
        }

        function hidePwdChkbox(){
            pwd.addClass('hidden');
            chkbox.addClass('hidden');
        }

        function changeImg(data){
            img.removeAttr('src').attr('src', data);
        }

        function dataImg(data){
            img.attr('data-img', data);
        }

        function changeImgBg(data){
            if(data){
                img.addClass('grow');
            } else {
                img.removeClass('grow');
            }
        }

        function changeBtnType(data,text){
            setTimeout(function(){
                btn.attr('type', data);
                btn.html(text);
            }, 1000);
        }

        function hi(data){
            msg.html('Hi ' + data + '!');
        }

        $(email).keypress(function(key){
            if (key.keyCode == 13 && !key.shiftKey){
                btn.click();
            }
        });

        back.click(function(){
            if(!sb){
                slideLeft();
                changeBtnType(data='submit', text='LOGIN');
                sb = true;
            } else{
                slideRight();
                setTimeout(function(){
                    hidePwdChkbox();
                }, 2000);
                changeBtnType(data='button', text='NEXT');
                sb = false;
                msg.html('');
            }
        });

        btn.click(function(){
            reset();
            if(btn.attr('type') === 'button'){
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
                        showPwdChkbox();
                        hi(data.username);
                        changeImgBg(true);
                        dataImg(true);
                        changeImg(data.foto);
                        back.click();
                        changeBtnType(data = 'submit',text='LOGIN');
                    }
                });
            }
        });
    });
JS;
$this->registerJs($mailcheck);
}
?>
<?php
$sw = <<< JS
$(document).ready(function(){
    var hash = '#';
    var blank = '';

    function syncValue(elem){
        if(elem.defaultValue !== elem.previousElementSibling.defaultValue){
            elem.previousElementSibling.defaultValue = elem.defaultValue;
        }
    }

    function changeState(elem){
        if(parseInt(elem.defaultValue) === 1){
            elem.checked = false;
            $(elem).attr('checked', false);
            elem.previousElementSibling.defaultValue = 1;
        } else {
            elem.checked = true;
            $(elem).attr('checked', true);
            elem.previousElementSibling.defaultValue = 0;
        }
    }
    
    if (Array.prototype.forEach) {
        var i = 0;
        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
        
        elems.forEach(function(html) {
            syncValue(elems[i]);
            changeState(elems[i]);
            var switchery = new Switchery(html, {size: 'small', speed: '0.2s'});

            elems[i].onchange = function() { 
                if(this.checked){
                    this.defaultValue = 0;
                    changeState(this);
                }else {
                    this.defaultValue = 1;
                    changeState(this);
                }
            };
            i++;
        });
    } else {
        var i = 0;
        var elems = document.querySelectorAll('.js-switch');

        for (i ; i < elems.length; i++) {
            syncValue(elems[i]);
            changeState(elems[i]);
            var switchery = new Switchery(elems[i], {size: 'small', speed: '0.2s'});

            elems[i].onchange = function() { 
                if(this.checked){
                    this.defaultValue = 0;
                    changeState(this);
                }else {
                    this.defaultValue = 1;
                    changeState(this);
                }
            };
        }
    }
});
JS;
$this->registerJs($sw);
?>