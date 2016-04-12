<?php
use app\rbac\models\AuthItem;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<p></p>
<?php $form = ActiveForm::begin(['id' => 'form-user']); ?>
<div class="user-form">
    <div class="row">
            <div class="col-lg-9 col-md-9 col-12">
                <div id="user-form-wrap" class="panel panel-default">
                    <div class="panel-body">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div id="user-profile-img-wrap">
                                <div id="user-profile-image-bg" style="background: url('../uploads/ui/user-default.png'); background-size: contain;"></div>
                                <img id="user-student-profile-image" class="animated2 fastShrink hidden" src="../uploads/ui/user-blue.png" alt="student"  data-write="false">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <?= $form->field($user, 'username', ['inputTemplate' => '<div class="input-div-wrap"><label>Username</label>{input}</div>', 'inputOptions' => ['class' => 'form-control pva-form-control']])->label(false) ?>
                            <?= $form->field($user, 'email', ['inputTemplate' => '<div class="input-div-wrap"><label>Email</label>{input}</div>', 'inputOptions' => ['class' => 'form-control pva-form-control']])->label(false) ?>
                            <?php if ($user->scenario === 'create'): ?>
                                <?= $form->field($user, 'password', ['inputTemplate' => '<div class="input-div-wrap"><label>Password</label>{input}</div>', 'inputOptions' => ['type' => 'password', 'class' => 'form-control pva-form-control']])->label(false) ?>
                                <div class="pull-left"><label for="Show/Hide">Show Password</label></div><div class="pull-right"><input type="checkbox" class="js-switch" title="Show/Hide" value="1"></div>
                                <br>
                            <?php else: ?>
                                <?= $form->field($user, 'password', ['inputTemplate' => '<div class="input-div-wrap"><label>Password</label>{input}</div>', 'inputOptions' => ['type' => 'password', 'class' => 'form-control pva-form-control']])->label(false) ?>    
                            <?php endif ?>
                            <div class="row">
                                <br>
                                <div class="col-lg-12 col-md-12 col-sm-12" style="padding: 0;">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <?php foreach (AuthItem::getRoles() as $item_name): ?>
                                            <?php $roles[$item_name->name] = ucfirst($item_name->name) ?>
                                        <?php endforeach ?>
                                        <?= $form->field($role, 'item_name', ['inputTemplate' => '<div class="input-div-wrap"><label>Role</label>{input}</div>'])->dropDownList($roles,['class' => 'form-control pva-form-control'])->label(false) ?>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <?= $form->field($user, 'status', ['inputTemplate' => '<div class="input-div-wrap"><label>Status</label>{input}</div>'])->dropDownList($user->statusList,['class' => 'form-control pva-form-control'])->label(false) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>      
        <div class="col-lg-3 col-md-3 col-sm-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <?= Html::submitButton($user->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Save'), ['class' => $user->isNewRecord ? 'btn btn-success btn-block' : 'btn btn-primary btn-block']) ?>
                    <?= Html::a(Yii::t('app', 'Cancel'), ['user/index'], ['class' => 'btn btn-default btn-block']) ?>
                </div>
            </div>
        </div>        
    </div>
</div>
<?php ActiveForm::end(); ?>
<?php
$sw = <<< JS
$(document).ready(function(){
    var p = $('#user-password');
    var elem = document.querySelector('.js-switch');
    var toggle = new Switchery(elem, {size: 'small', speed: '0.2s'});
    toggle.checked = false;

    elem.onchange = function(){
        if(this.checked){
            p.attr('type', 'text');
        }else {
            p.attr('type', 'password');
        }
    };
});
JS;
$this->registerJs($sw);
?>