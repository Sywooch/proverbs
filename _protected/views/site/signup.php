<?php
use nenad\passwordStrength\PasswordInput;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \app\models\SignupForm */

$this->title = Yii::t('app', 'Sign Up');
//$this->params['breadcrumbs'][] = $this->title;
?>
<?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
<div class="pva-login-mask">
    <a id="btn-login" href="login" class="btn btn-primary btn-lg rounded-edge">LOGIN</a>
    <div class="pva-form">
        <div class="pva-form-wrap">
            <div class="pva-form-login">
                <div class="panel panel-default form-login">
                    <div class="panel-body">
                        <p>
                            <?php
                                //var_dump(Yii::$app->session->id);
                                if(empty($model->errors)){
                                    //var_dump($model->errors);
                                } else {
                                    //var_dump($model->errors);
                                }
                            ?>
                        </p>
                        <div id="user-check-img-wrap">
                            <img id="user-check-img" class="animated2" src="<?= Yii::$app->request->baseUrl . '/uploads/ui/user-default.png'?>" alt="user" data-img="false">
                        </div>
                        <p></p>
                        <span id="span-login-nav"><i id="back" class="fa fa-arrow-left fa-one-point-five i-back-btn invisible slide-in-right"></i></span>
                        <p></p>
                        <div id="check-email">
                            <div id="slide-form">
                                <div id="slide-mail" class="animated">
                                    <div id="slide-content2" class="row" style="margin: 0; padding: 0;">
                                        <div class="mail" style="">
                                            <?= $form->field($model, 'username',['inputTemplate' => '{input}','inputOptions' => ['id' => 'input-username-check', 'style' => 'margin-bottom: -10px;', 'class' => 'form-control pva-border', 'placeholder' => 'Username']])->label(false) ?>
                                            <?= $form->field($model, 'email',['inputTemplate' => '{input}','inputOptions' => ['id' => 'input-mail-check', 'style' => 'margin-bottom: -10px;',  'class' => 'form-control pva-border', 'placeholder' => 'Email']])->label(false) ?>     
                                            <?= $form->field($model, 'password',['inputTemplate' => '{input}','inputOptions' => ['id' => 'input-password-check', 'style' => 'margin-bottom: -10px;', 'class' => 'form-control pva-border', 'placeholder' => 'Password']])->passwordInput()->label(false); ?>
                                        </div>
                                        <div class="vfy" style="">
                                            <?= $form->field($model, 'verifyCode')->label(false)->widget(Captcha::className(), ['template' => '<div class="display: inline;"><label class="pull-left" style="color: white;">Captcha Code: </label><div class="text-right">{image}</div><div style="margin-top: 25px; margin-bottom: 25px; color: white;">* * Click image to generate new captcha code</div></div><p></p>{input}']) ?>
                                        </div>
                                    </div>
                                </div>                                
                            </div>
                            <div class="slide-btn">
                                <button type="button" id="btn-info-check" class="btn btn-primary btn-block pva-border" style="height: 46px; background: #337AB7; border: 0;" data-toggle="modal" data-target="#verify">NEXT</button>
                            </div>
                        </div>
                        <p id="msg-info-check" style="color: white; font-size: 16px; margin-top: 20px;"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$su = <<< JS
$(document).ready(function(){
    $('.help-block.help-block-error').addClass('hidden');
    var btn = $('#btn-info-check');
    var msg = $('#msg-info-check');
    var usn = $('#input-username-check');
    var email = $('#input-mail-check');
    var pwd = $('#input-pwd-check');
    var back = $('#back');
    var sb = false;
    
    function slideLeft(){
        $('#slide-form').attr('style', 'left: -330px;');
        back.removeClass('invisible').removeClass('slide-in-right').addClass('slide-in-left');
        back.removeClass('fa-arrow-right').addClass('fa-arrow-left');
    }

    function slideRight(){
        $('#slide-form').attr('style', 'left: 0;');
        back.addClass('invisible').removeClass('slide-in-left').addClass('slide-in-right');
        back.removeClass('fa-arrow-left').addClass('fa-arrow-right');
    }

    btn.click(function(){
        if(btn.attr('type') === 'button'){
            slideLeft();
            changeBtnType(data='submit', text='SUBMIT');
            sb = true;
        } else {

        }
    });

    back.click(function(){
        if(!sb){
            slideLeft();
            changeBtnType(data='submit', text='SUBMIT');
            sb = true;
        } else{
            slideRight();
            changeBtnType(data='button', text='NEXT');
            sb = false;
        }
    });

    function changeBtnType(data,text){
        setTimeout(function(){
            btn.attr('type', data);
            btn.html(text);
        }, 1000);
    }
});
JS;
$this->registerJs($su);
?>
<?php ActiveForm::end(); ?>