<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use app\models\ApplicantForm;
use app\models\Card;
use app\models\Options;

$avatar = Yii::$app->request->baseUrl . Yii::$app->params['avatar'];
!$model->isNewRecord ? !empty($model->applicant->students_profile_image) ? $img = Yii::$app->request->baseUrl . '/uploads/students/' . $model->applicant->students_profile_image : $img = $avatar : '';
!$model->isNewRecord ? !empty(trim($model->applicant->middle_name)) ? $middle = ucfirst(substr($model->applicant->middle_name, 0,1)).'.' : $middle = '' : '';
!$model->isNewRecord ? $this->title = implode(' ', [$model->applicant->first_name, $middle, $model->applicant->last_name]) : 'New';

$model->isNewRecord ? $this->title = 'New' : $this->title = implode(' ', [$model->applicant->first_name, $middle, $model->applicant->last_name]);
?>
<p></p>
<?php $form = ActiveForm::begin(); ?>
<div class="ui three column stackable grid">
    <div class="four wide rounded column">
        <?= Card::render($options = [
            'imageContent' => !$model->isNewRecord ? !empty($model->applicant->students_profile_image) ? ['/file', 'id' => $model->applicant->students_profile_image] : Yii::$app->request->baseUrl . Yii::$app->params['avatar'] : Yii::$app->request->baseUrl . Yii::$app->params['avatar'],
            'labelContent' => !$model->isNewRecord ? implode(' ', ['ID#', '<strong>', $model->applicant_id, '</strong>']) : '&nbsp;',
            'labelFor' => 'Applicant ID',
            'labelOptions' => '',
            'headerContent' => !$model->isNewRecord ? implode(' ', [$model->applicant->first_name, $middle, $model->applicant->last_name]) : '&nbsp;',
            'headerOptions' => '',
            'metaContent' => !$model->isNewRecord ? implode('', ['\'', $model->applicant->nickname, '\'']) : '&nbsp',
            'metaOptions' => '',
            'leftFloatedContent' => !$model->isNewRecord ? $model->applicant->gradeLevel->name : '&nbsp;',
            'leftFloatedFor' => '',
            'leftFloatedOptions' => '',
            'rightFloatedContent' => '',
            'rightFloatedOptions' => !$model->isNewRecord ? $model->applicant->sped === 0 ? '' : 'hidden' : 'hidden'
        ]) ?>
    </div>
    <div class="nine wide rounded column">
        <div class="ui segment">
            <?= !$model->isNewRecord ? Html::tag('label',implode('', [implode('-', array_map('ucfirst', explode('-', Yii::$app->controller->id))),'# ', $model->id]), ['class' => 'ui fluid big label']) : '' ?>
            <br><br>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <?= $model->isNewRecord ? $form->field($model, 'applicant_id', ['inputTemplate' => '<label style="padding: 0; color: #555; font-weight: 600;" for="Applicant">Applicant</label>{input}', 'inputOptions' => ['class' => 'form-control pva-form-control'] ])->widget(Select2::classname(), [
                        'data' => ArrayHelper::map(ApplicantForm::find()->where(['status' => 2])->orderBy(['first_name' => SORT_ASC])->all(),'id', function($model){
                            return implode(' ', [$model->first_name, $model->middle_name, $model->last_name]);
                        }),
                        'language' => 'en',
                        'options' => ['id' => 'auto-suggest','placeholder' => 'Select Applicant', 'class' => 'form-control pva-form-control'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                        'pluginEvents' => [
                            'change' => "
                                run = function(){
                                        $.ajax({
                                            type: 'POST',
                                            url: 'card?data=' + JSON.stringify({sid:$('#auto-suggest').val(),}),
                                            contentType: 'application/json; charset=utf-8',
                                            dataType: 'json',
                                            success: function(data) {
                                                $('#header-label').html('ID# ' + '<strong>' + data.sid + '</strong>');
                                                $('#header-content').html(data.name);
                                                $('#meta-content').html(data.nick);
                                                $('#left-content').html(data.level);

                                                if(data.spd === 0){
                                                    $('#right-content').removeClass('hidden');
                                                }

                                                if(data.img !== 'empty'){
                                                    $('.tiny.image').attr('src', data.img);
                                                }else {
                                                    $('.tiny.image').attr('src', '/proverbs/uploads/ui/user-blue.svg');
                                                }
                                            }
                                        });
                                }, function(){
                                    if($('#auto-suggest').val() === ''){
                                        $('#header-label').html('&nbsp;');
                                        $('#header-content').html('&nbsp;');
                                        $('#meta-content').html('&nbsp;');
                                        $('#left-content').html('&nbsp;');
                                        $('.tiny.image').attr('src', '/proverbs/uploads/ui/user-blue.svg');
                                        $('#right-content').addClass('hidden');
                                    }else {
                                        run();
                                    }
                                }
                            ",
                        ],
                    ])->label(false) : ''; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <?= $form->field($model, 'english', ['inputTemplate' => '<label for="English">English</label>{input}', 'inputOptions' => [] ])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <?= $form->field($model, 'reading_skills', ['inputTemplate' => '<label for="Reading Skills">Reading Skills</label>{input}', 'inputOptions' => [] ])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <?= $form->field($model, 'science', ['inputTemplate' => '<label for="Science">Science</label>{input}', 'inputOptions' => [] ])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <?= $form->field($model, 'comprehension', ['inputTemplate' => '<label for="Comprehension">Comprehension</label>{input}', 'inputOptions' => [] ])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?>
                </div>
            </div>
            <div class="ui divider"></div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <?= $form->field($model, 'remarks', ['inputTemplate' => '<label for="Remarks">Remarks</label>{input}', 'inputOptions' => [] ])->dropDownList([10 => 'For Evaluation', 0 => 'Passed', 1 => 'Failed'],['class' => 'form-control pva-form-control'])->label(false) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <?= $form->field($model, 'recommendations', ['inputTemplate' => '<label for="Recommendations">Recommendations</label>{input}', 'inputOptions' => [] ])->dropDownList([10 => 'For Evaluation', 0 => 'Promoted', 1 => 'Retained'],['class' => 'form-control pva-form-control'])->label(false) ?>
                </div>
            </div>
        </div>
    </div>
    <div class="three wide rounded column">
        <div class="column">
            <?= Options::render(['scenario' => Yii::$app->controller->action->id,'id' => $model->id, 'exist' => false]); ?>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>
<?= $this->render('/layouts/_toast', ['model' => $model])?>
