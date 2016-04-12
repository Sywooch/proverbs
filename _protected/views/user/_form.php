<?php
use app\rbac\models\AuthItem;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
CONST ACTIVE = 10;
CONST INACTIVE = 1;
CONST DELETED = 0;
?>
<p></p>
<?php $form = ActiveForm::begin(['id' => 'form-user']); ?>
<div class="user-form">
    <div class="row">
            <div class="col-lg-9 col-md-9 col-12">
                <div id="user-form-wrap" class="panel panel-default">
                    <div class="panel-body">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="gridview-role-type" style="margin-left: -24px; margin-top: -12px;"><div id="role-badge" class="square-badge"><span>A</span></div></div>
                            <div id="user-profile-img-wrap">
                                <div id="user-profile-image-bg" style="background: url('../uploads/ui/user-default.png'); background-size: contain;"></div>
                                <img id="user-student-profile-image" class="animated2 fastShrink hidden" src="../uploads/ui/user-blue.png" alt="student"  data-write="false">
                            </div>
                            <div id="st" class="user-halo-state-update active"></div>
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
                                <label><em>Enter a new password if you want to change</em></label>
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
if($user->isNewRecord){
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
}
if(!$user->isNewRecord){
    if(!empty($user->profile_image)){
        $img = $user->profile_image;
        $json = json_encode(Yii::$app->request->baseUrl . '/uploads/profile-img/' .$img);
    }else {
        $img = null;
        $json = json_encode(null);
    }
}else {
    $img = null;
    $json = json_encode(null);
}
$pf = <<< JS
$(document).ready(function(){
    var irb = $('#role-badge');
    var irbt = $('#role-badge>span');
    var img = $json;
    var st = $('#st');
    var uimg = $('#user-student-profile-image');
    var srole = $('#role-item_name');
    var sstate = $('#user-status');
    var irole = srole.val();
    var istate = parseInt(sstate.val());

    if(img != null){
        uimg.attr('src', img).addClass('grow').removeClass('fastShrink').removeClass('hidden');    
    }
    
    function halo(istate){
        if(parseInt(istate) === 10){
            st.addClass('active');
            st.data('state','active');
        }else if(parseInt(istate) === 1){
            st.addClass('inactive');
            st.data('state','inactive');
        }else if(parseInt(istate) === 0){
            st.addClass('deleted');
            st.data('state','deleted');
        }
    }

    function badge(irole){
        if(irole === 'admin'){
            irb.addClass('admin-badge');
            irb.data('state','admin-badge');
            irbt.text('A');

        }else if(irole === 'cashier'){
            irb.addClass('cashier-badge');
            irb.data('state','cashier-badge');
            irbt.text('C');

        }else if(irole === 'dev'){
            irb.addClass('dev-badge');
            irb.data('state','dev-badge');
            irbt.text('D');

        }else if(irole === 'master'){
            irb.addClass('master-badge');
            irb.data('state','master-badge');
            irbt.text('M');

        }else if(irole === 'principal'){
            irb.addClass('principal-badge');
            irb.data('state','principal-badge');
            irbt.text('P');

        }else if(irole === 'teacher'){
            irb.addClass('teacher-badge');
            irb.data('state','teacher-badge');
            irbt.text('T');

        }else if(irole === 'staff'){
            irb.addClass('staff-badge');
            irb.data('state','staff-badge');
            irbt.text('S');

        }else {
            irb.addClass('parent-badge');
            irb.data('state','parent-badge');
            irbt.text('P');
        }
    }

    console.log(istate);
    halo(istate);
    badge(irole);
    
    srole.change(function(){
        irb.removeClass(irb.data('state'));
        badge($(this).val());
    });

    sstate.change(function(){
        st.removeClass(st.data('state'));
        halo($(this).val());
    });

    //console.log(st.data('state'));
});
JS;
$this->registerJs($pf);

?>