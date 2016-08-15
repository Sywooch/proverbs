<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\models\GradeLevel;
use yii\helpers\ArrayHelper;
use app\rbac\models\AuthAssignment;
use app\models\ProfileForm;
use app\models\DataRequest;
use app\models\DataHelper;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model app\models\DataRequest */
/* @var $form yii\widgets\ActiveForm */
$avatar = Yii::$app->request->baseUrl . Yii::$app->params['avatar'];
?>

<div class="data-request-form">

    <?php $form = ActiveForm::begin(); ?>
        <div class="ui three column stackable grid">
            <div class="four wide rounded column">
                <div class="ui center aligned stackable cards">
                    <div class="card">
                        <div class="image">
                            <?php $userRequest = ProfileForm::findOne($model->user_id); ?>
                            <?php if(!empty(DataHelper::profileImage($model->user_id) )) : ?>
                                <?= Html::img(['/file','id'=> DataHelper::profileImage($model->user_id)]); ?>
                            <?php else :?>
                                <?= Html::img([Yii::$app->params['avatar'], ['alt' => 'user', 'class' => 'tiny image']]) ?>
                            <?php endif ?>
                        </div>
                        <div class="ui center aligned content">
                            <h6><?= $userRequest->username; ?></h6>
                            <span>
                                <?= DataHelper::name($userRequest->first_name, $userRequest->middle_name, $userRequest->last_name) ?>
                            </span>
                        </div>
                        <div class="extra content">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    Parent
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="nine wide rounded column">
                <div class="ui segment">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <?= $form->field($model, 'request_text', ['inputTemplate' => '<label>Request Details</label>{input}', 'inputOptions' => [] ])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <?= $form->field($model, 'student_id', ['inputTemplate' => '<label>Student</label>{input}', 'inputOptions' => [] ])
                                ->widget(Select2::classname(), [
                                'data' => ArrayHelper::map(app\models\StudentForm::find()->orderBy(['first_name' => SORT_ASC])->all(), 'id',
                                    function($model){
                                        return implode(' ', ['#' . $model->id, ': ', $model->first_name, $model->middle_name, $model->last_name]);
                                    }),
                                'language' => 'en',
                                'options' => ['id' => 'auto-suggest','placeholder' => 'Select Student'],
                                'pluginOptions' => [
                                    'allowClear' => true,
                                ],
                            ])->label(false) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <?= $form->field($model, 'request_status', ['inputTemplate' => '<label>Request Status</label>{input}', 'inputOptions' => ['class' => 'form-control pva-form-control'] ])->dropDownList(['1' => 'Processing', '2' => 'Approved', '3' => 'Denied'])->label(false) ?>
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
                            <?= Html::submitButton($model->isNewRecord ? 'Add' : 'Save' , ['class' => 'ui link fluid huge primary submit button', 'style' => 'color: white;']) ?>
                            <br>
                            <?php if(!$model->isNewRecord): ?>
                            <?= Html::a(Yii::t('app', 'View'),['view', 'id' => $model->id], ['class' => 'ui link fluid huge teal button']) ?>
                            <br>
                            <?php endif ?>
                            <?= Html::a(Yii::t('app', 'Cancel'),['/request'], ['class' => 'ui link fluid huge grey button']) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php ActiveForm::end(); ?>

</div>
