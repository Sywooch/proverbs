<?php
use app\rbac\models\AuthItem;
use nenad\passwordStrength\PasswordInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $user app\models\User */
/* @var $form yii\widgets\ActiveForm */
/* @var $role app\rbac\models\Role; */
?>
<div class="user-form">
    <?php $form = ActiveForm::begin(['id' => 'form-user']); ?>
        <?= $form->field($user, 'username') ?>
        <?= $form->field($user, 'email') ?>

        <?php if ($user->scenario === 'create'): ?>
            <?= $form->field($user, 'password')->widget(PasswordInput::classname(), []) ?>
        <?php else: ?>
            <?= $form->field($user, 'password')->widget(PasswordInput::classname(), [])
                     ->passwordInput(['placeholder' => Yii::t('app', 'New pwd ( if you want to change it )')]) 
            ?>       
        <?php endif ?>
        
        <div class="row">
            <div class="container form-input-wrapper">
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <?= $form->field($user, 'status')->dropDownList($user->statusList) ?>
                    <?php foreach (AuthItem::getRoles() as $item_name): ?>
                        <?php $roles[$item_name->name] = $item_name->name ?>
                    <?php endforeach ?>
                    <?= $form->field($role, 'item_name')->dropDownList($roles) ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="container form-input-wrapper">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <?= Html::submitButton($user->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $user->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                    <?= Html::a(Yii::t('app', 'Cancel'), ['user/index'], ['class' => 'btn btn-default']) ?>
                </div>
            </div>
        </div> 
    <?php ActiveForm::end(); ?>
</div>