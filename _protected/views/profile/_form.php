<?php

use app\rbac\models\AuthItem;
use yii\helpers\Html;
use yii\jui\DatePicker;
use nesbot\Carbon;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use yii\widgets\Pjax;
use app\models\DataHelper;
$avatar = Yii::$app->request->baseUrl . Yii::$app->params['avatar'];
!empty($model->profile_image) ? $img = Yii::$app->request->baseUrl . '/uploads/users/' . $model->profile_image : $img = $avatar;
?>
<p></p>
<?php $form = ActiveForm::begin(['class' => 'ui loading form']); ?>
<div class="ui three column stackable grid">
    <div class="four wide rounded column">
    <?php Pjax::begin(['id' => 'profile-card', 'timeout' => 60000]); ?>
    <div class="ui center aligned stackable special cards">
        <div class="card">
            <div class="image">
                <div id="image-upload-wrap">
                    <div id="image-upload-button">
                        <?= $form->field($model,'file')->fileInput(['id' => 'file-upload-btn', 'class' => '', 'style' => 'color: #fff;'])->label(false); ?>
                    </div>
                </div>
                <?php if(!empty($model->profile_image)) : ?>
                    <?= Html::img(['/file','id'=>$model->profile_image]) ?>
                <?php else :?>
                    <?= Html::img([Yii::$app->params['avatar'], ['alt' => 'user', 'class' => 'tiny image']]) ?>
                <?php endif ?>
            </div>
            <div class="ui center aligned content">
                <label><em><?= $model->email ?></em></label>
                <div class="header">
                    <?= DataHelper::name($model->first_name, $model->middle_name, $model->last_name) ?>
                    <p></p>
                </div>
                <div class="meta">
                    <span id="meta-content"><?= implode('', ['\'', $model->username, '\'']) ?></span>
                    <p></p>
                </div>
            </div>
            <?php if(app\rbac\models\AuthAssignment::getAssignment(Yii::$app->user->identity->id) !== 'parent') : ?>
                <div class="extra center aligned content">
                    <label class="user-id"><span><?= ucfirst($model->role->item_name) ?></span></label>
                </div>
            <?php endif ?>
        </div>
    </div>
    <?php Pjax::end(); ?>
    </div>
    <div class="nine wide rounded column">
        <div class="ui rounded segment">
            <?= !$model->isNewRecord ? Html::tag('label',implode('', [implode('-', array_map('ucfirst', explode('-', Yii::$app->controller->id))),'# ', $model->id]), ['class' => 'ui fluid big label']) : '' ?>
            <br><br>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <?= $form->field($model, 'first_name', ['inputTemplate' => '<label>First Name</label>{input}','inputOptions' => [] ])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <?= $form->field($model, 'middle_name', ['inputTemplate' => '<label>Middle Name</label>{input}','inputOptions' => [] ])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <?= $form->field($model, 'last_name', ['inputTemplate' => '<label>Last Name</label>{input}','inputOptions' => [] ])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <?= $form->field($model, 'username', ['inputTemplate' => '<label>Username</label>{input}','inputOptions' => [] ])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <?= $form->field($model, 'gender', ['inputTemplate' => '<label>Gender</label>{input}','inputOptions' => [] ])->dropDownList([0 => 'Male', 1 => 'Female'],['class' => 'form-control pva-form-control'])->label(false) ?>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <?= $form->field($model, 'birth_date', ['inputTemplate' => '<label>Birth Date</label>{input}','inputOptions' => [] ])->label(false)
                        ->widget(DatePicker::className(),['options' => ['class' => 'form-control pva-form-control']] ) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12">

                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12">
                    <?= $form->field($model, 'email', ['inputTemplate' => '<label>Email</label>{input}','inputOptions' => [] ])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12">
                    <?= $form->field($model, 'address', ['inputTemplate' => '<label>Address</label>{input}','inputOptions' => [] ])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <?= $form->field($model, 'phone', ['inputTemplate' => '<label>Phone</label>{input}','inputOptions' => [] ])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <?= $form->field($model, 'mobile', ['inputTemplate' => '<label>Mobile</label>{input}','inputOptions' => [] ])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?>
                </div>
            </div>
        </div>
    </div>
    <div class="three wide rounded column">
        <div class="column">
            <div class="ui fluid vertical menu">
                <div class="ui fluid huge label item">
                    <span>Options</span>
                </div>
                <div class="item">
                    <p></p>
                    <?= Html::submitButton($model->isNewRecord ? 'Add' : 'Save' , ['class' => 'ui link fluid huge primary submit button', 'style' => 'color: white;']) ?>
                    <p></p>
                    <?php if(Yii::$app->user->id === $model->id){
                            echo Html::a(Yii::t('app', 'View'),['index'], ['class' => 'ui link fluid huge teal button']);
                        }else {
                            echo Html::a(Yii::t('app', 'View'),['view', 'id' => $model->id], ['class' => 'ui link fluid huge teal button']);
                        }
                    ?>
                    <p></p>
                    <?= Html::a(Yii::t('app', 'Cancel'),['/profile'], ['class' => 'ui link fluid huge grey button']) ?>
            </div>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>
