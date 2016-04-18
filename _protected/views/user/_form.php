<?php
use app\rbac\models\AuthItem;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$avatar = Yii::$app->request->baseUrl . Yii::$app->params['avatar'];

if($user->scenario !== 'create'){
    !empty($user->profile_image) ? $img = Yii::$app->request->baseUrl . '/uploads/users/' . $user->profile_image : $img = $avatar;
} else {
    $img = $avatar;
}

?>
<p></p>
<?php $form = ActiveForm::begin(['class' => 'ui loading form']); ?>
<div class="ui three column stackable grid">
    <div class="four wide rounded column">
        <div class="ui center aligned stackable cards">
            <div class="card">
                <div class="image"><img src="<?= $img ?>" class="tiny image"></div>
                <div class="ui center aligned content">
                    
                </div>
                <div class="extra content">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <?php foreach (AuthItem::getRoles() as $item_name): ?>
                                <?php $roles[$item_name->name] = ucfirst($item_name->name) ?>
                            <?php endforeach ?>
                            <?= $form->field($role, 'item_name', ['inputTemplate' => '<label for="Role" style="font-weight: 600; color: #555;">Role</label>{input}'])->dropDownList($roles, ['class' => 'form-control pva-form-control'])->label(false) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="nine wide rounded column">
        <div class="panel panel-default rounded-edge">
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <?= $form->field($user, 'status', ['inputTemplate' => '<label for="Status" style="font-weight: 600; color: #555;">Status</label>{input}'])->dropDownList($user->statusList, ['class' => 'form-control pva-form-control'])->label(false) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <?= $form->field($user, 'username', ['inputTemplate' => '<label>Username</label>{input}','inputOptions' => [] ])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-12">
                        <?= $form->field($user, 'email', ['inputTemplate' => '<label>Email</label>{input}','inputOptions' => [] ])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-12">
                        <?php if ($user->scenario === 'create'): ?>
                            <?= $form->field($user, 'password', ['inputTemplate' => '<label>Password</label>{input}','inputOptions' => [] ])->label(false)->textInput(['id' => 'user-password', 'type' => 'password', 'class' => 'form-control pva-form-control'], ['maxlength' => true]) ?>
                            <div class="pull-left"><label for="Show/Hide">Show Password</label></div><div class="pull-right"><input type="checkbox" class="js-switch" title="Show/Hide" value="1"></div>
                            <br>
                        <?php else: ?>
                            <?= $form->field($user, 'password', ['inputTemplate' => '<label>Password</label>{input}','inputOptions' => [] ])->label(false)->textInput(['id' => 'user-password', 'type' => 'password', 'class' => 'form-control pva-form-control'], ['maxlength' => true]) ?>                            
                            <label><em>Enter a new password (if you wish to change)</em></label>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="three wide rounded column">
        <div class="column">
            <?= Html::submitButton($user->scenario === 'create' ? '<i class="left floated icon plus" style="color: white;"></i>New' : 'Save' , ['class' => 'ui link fluid huge primary submit button', 'style' => 'color: white;']) ?>
            <p></p>
            <?php if($user->scenario !== 'create'): ?>
            <?= Html::a(Yii::t('app', 'View'),['update', 'id' => $user->id], ['class' => 'ui link fluid huge info button']) ?>
            <p></p>
            <?php endif ?>
            <?= Html::a(Yii::t('app', 'Cancel'),['/user'], ['class' => 'ui link fluid huge basic button']) ?>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>
<?php
if($user->scenario === 'create'){
$sw = <<< JS
$(document).ready(function(){
    var p = $('#user-password');
    var elem = document.querySelector('.js-switch');
    var toggle = new Switchery(elem, {size: 'small', speed: '0.2s'});

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
?>