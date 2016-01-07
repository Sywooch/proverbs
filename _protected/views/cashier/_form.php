<?php
use app\rbac\models\AuthItem;
use nenad\passwordStrength\PasswordInput;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $user app\models\User */
/* @var $form yii\widgets\ActiveForm */
/* @var $role app\rbac\models\Role; */
?>
<div class="staff-form-index">
    <?php $form = ActiveForm::begin(['id' => 'form-index-staff']); ?>
    <div class="row">
        <div class="container form-input-wrapper">
            <div class="col-lg-2 col-md-2 col-sm-12"><?= $form->field($user, 'status')->dropDownList($user->statusList)->label(false) ?></div>
            <?php foreach (AuthItem::getRoles() as $item_name): ?>
            <?php $roles[$item_name->name] = $item_name->name ?>
            <?php endforeach ?>
            <div class="col-lg-2 col-md-2 col-sm-12"><?= $form->field($role, 'item_name', ['inputTemplate' => '{input}' ,'inputOptions' => ['style' => 'display: none;']])->dropDownList(['staff' => 'staff'])->label(false) ?></div>
        </div>
    </div>
    <div class="row">
        <div class="container form-input-wrapper">
            <div class="col-lg-4 col-md-4 col-sm-12"><?= $form->field($user, 'username', ['inputTemplate' => '<div class="input-group"><span class="input-group-addon"><i class="fa fa-user fa-one-point-five"></i></span></span>{input}</div>' ,'inputOptions' => ['placeholder' => 'Username']])->label(false) ?></div>
        </div>
    </div>
    <div class="row">
        <div class="container form-input-wrapper">
            <div class="col-lg-4 col-md-4 col-sm-12"><?= $form->field($user, 'email', ['inputTemplate' => '<div class="input-group"><span class="input-group-addon"><i class="fa fa-envelope fa-one-point-five"></i></span></span>{input}</div>' ,'inputOptions' => ['placeholder' => 'Email']])->label(false) ?></div>
        </div>
    </div>
    <div class="row">
        <div class="container form-input-wrapper">
            <div class="col-lg-4 col-md-4 col-sm-12">
                <?php if ($user->scenario === 'create'): ?>
                    <?= $form->field($user, 'password')->label(false)->widget(PasswordInput::classname(), []) ?>
                <?php else: ?>
                    <?= $form->field($user, 'password')->label(false)->widget(PasswordInput::classname(), [])
                             ->passwordInput(['placeholder' => Yii::t('app', 'New pwd ( if you want to change it )')]) 
                    ?>       
                <?php endif ?>
            </div>
        </div>
    </div>
    <div class="form-group">     
        <?= Html::submitButton($user->isNewRecord ? Yii::t('app', 'Create') 
            : Yii::t('app', 'Update'), ['class' => $user->isNewRecord 
            ? 'btn btn-success' : 'btn btn-primary']) ?>

        <?= Html::a(Yii::t('app', 'Cancel'), ['/teachers'], ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>
 
</div>
