<?php

use yii\web\View;
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use kartik\select2\Select2;
use app\models\ApplicantForm;
use app\models\ActiveRecord;
use app\models\StudentForm;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use app\models\GradeLevel;
use app\models\Section;
use app\models\SchoolYear;
use app\models\Card;
use app\models\DataHelper;

$current_date = date('Y');
$school_year = SchoolYear::find()->orderBy(['id' => SORT_DESC])->all();
$section = Section::find()->all();
$grade_level = GradeLevel::find()->where(['!=', 'id', 0])->all();
$status = [['id' => 1, 'status' => 'Pending'], ['id' => 0, 'status' => 'Enrolled']];

$listData = ArrayHelper::map($grade_level, 'id' , 'name');
$listData2 = ArrayHelper::map($school_year, 'id' , 'sy');
$listData3 = ArrayHelper::map($section, 'id' , 'section_name');
$listData4 = ArrayHelper::map($status, 'id', 'status');
$state = false;

$avatar = Yii::$app->request->baseUrl . Yii::$app->params['avatar'];
!$model->isNewRecord ? !empty($model->student->students_profile_image) ? $img = Yii::$app->request->baseUrl . '/uploads/students/' . $model->student->students_profile_image : $img = $avatar : '';
!$model->isNewRecord ? !empty(trim($model->student->middle_name)) ? $middle = ucfirst(substr($model->student->middle_name, 0,1)).'.' : $middle = '' : '';
!$model->isNewRecord ? $this->title = implode(' ', [$model->student->first_name, $middle, $model->student->last_name]) : 'New';

$model->isNewRecord ? $this->title = 'New' : $this->title = implode(' ', [$model->student->first_name, $middle, $model->student->last_name]);
?>
<?php $form = ActiveForm::begin(); ?>
<div class="ui three column stackable grid">
    <div class="four wide rounded column">
        <?= Card::render($options = [
            'imageContent' => !$model->isNewRecord ? !empty($model->student->students_profile_image) ? ['/file', 'id' => $model->student->students_profile_image] : Yii::$app->request->baseUrl . Yii::$app->params['avatar'] : Yii::$app->request->baseUrl . Yii::$app->params['avatar'],
            'labelContent' => !$model->isNewRecord ? implode(' ', ['ID#', '<strong>', $student->id, '</strong>']) : '&nbsp;',
            'labelFor' => 'Student ID',
            'labelOptions' => '',
            'headerContent' => !$model->isNewRecord ? DataHelper::name($model->student->first_name, $model->student->middle_name, $model->student->last_name) : '&nbsp;',
            'headerOptions' => '',
            'metaContent' => !$model->isNewRecord ? implode('', ['\'', $model->student->nickname, '\'']) : '&nbsp;',
            'metaOptions' => '',
            'leftFloatedContent' => !$model->isNewRecord ? DataHelper::gradeLevel($model->student->grade_level_id) : '&nbsp;',
            'leftFloatedFor' => 'Grade Level',
            'leftFloatedOptions' => '',
            'rightFloatedContent' => '',
            'rightFloatedOptions' => !$model->isNewRecord ? $model->student->sped === 0 ? '' : 'hidden' : 'hidden'
        ]) ?>
    </div>
    <div class="nine wide rounded column">
        <div class="ui segment">
        <?= !$model->isNewRecord ? Html::tag('label',implode('', [implode('-', array_map('ucfirst', explode('-', Yii::$app->controller->id))),'# ', $model->id]), ['class' => 'ui fluid big label']) : '' ?>
            <br>
            <br>
            <?php if($model->isNewRecord): ?>

            <?php else:?>
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <?= $form->field($model, 'enrollment_status', ['inputTemplate' => '<label style="padding: 0; color: #555; font-weight: 600;">Status</label>{input}', 'inputOptions' => ['class' => 'form-control pva-form-control'] ])->dropDownList($listData4,['id', 'status'])->label(false) ?>
                    </div>
                </div>
            <?php endif ?>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <?= $form->field($model, 'sy_id', ['inputTemplate' => '<label style="padding: 0; color: #555; font-weight: 600;">School Year</label>{input}', 'inputOptions' => ['class' => 'form-control pva-form-control'] ])->dropDownList($listData2, ['id', 'sy'])->label(false) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <?= $model->isNewRecord ? $form->field($model, 'student_id', ['inputTemplate' => '<label style="padding: 0; color: #555; font-weight: 600;">Student</label>{input}', 'inputOptions' => ['class' => 'form-control pva-form-control'] ])->widget(Select2::classname(), [
                        'data' => ArrayHelper::map(StudentForm::find()->orderBy(['first_name' => SORT_ASC])->where(['!=', 'status', 2])->all(),'id', function($model){
                            return implode(' ', [$model->first_name, $model->middle_name, $model->last_name]);
                        }),
                        'language' => 'en',
                        'options' => ['id' => 'auto-suggest','placeholder' => 'Select Student', 'class' => 'form-control pva-form-control'],
                        'size' => 'md',
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                        'pluginEvents' => [
                            'change' => "
                                run = function(){
                                        $.ajax({
                                            type: 'POST',
                                            url: 'card?data=' + JSON.stringify({
                                                    sid: $('#auto-suggest').val(),
                                                }),
                                            contentType: 'application/json; charset=utf-8',
                                            dataType: 'json',
                                            success: function(data) {
                                                $('#header-label').html('ID# ' + '<strong>' + data.sid + '</strong>');
                                                $('#header-content').html(data.name);
                                                $('#meta-content').html(data.nick);
                                                $('#left-content').html(data.level);

                                                if(parseInt(data.spd) === 0){
                                                    $('#right-content').removeClass('hidden');
                                                }

                                                if(data.img !== 'empty'){
                                                    $('.tiny.image').attr('src', data.img);
                                                    console.log(data.img);
                                                }else {
                                                    $('.tiny.image').attr('src', '/proverbs/uploads/ui/user-blue.svg');
                                                }

                                            }
                                        });
                                },
                                function(){
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
                                    $.post('". Yii::$app->urlManager->createUrl('enroll/grade-level?id=') . "'+parseInt($('#auto-suggest').val()), function(data){
                                        $('select#enrolledform-grade_level_id').val(data);
                                        $.post('". Yii::$app->urlManager->createUrl('enroll/section?id=') . "'+parseInt($('#enrolledform-grade_level_id').val()), function(data){
                                            $('#enrolledform-section_id').find('option').remove();
                                            $('#enrolledform-section_id').each(function(){
                                                $(this).append(data);
                                            });
                                        });
                                    });
                                }
                            ",
                        ],
                    ])->label(false) : ''; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <?= $form->field($model, 'grade_level_id', ['inputTemplate' => '<label style="padding: 0; color: #555; font-weight: 600;">Grade Level</label>{input}', 'inputOptions' => ['class' => 'form-control pva-form-control'] ])->dropDownList($listData,
                        [
                            'onchange' => "
                                level = function(){
                                    $('#left-content').html($('#enrolledform-grade_level_id').find('option:selected').text());
                                },
                                $.post('". Yii::$app->urlManager->createUrl('enroll/section?id=') . "'+parseInt($('#enrolledform-grade_level_id').val()), function(data){
                                    level();
                                    $('#enrolledform-section_id').find('option').remove();
                                    $('#enrolledform-section_id').each(function(){
                                        $(this).append(data);
                                    });
                                });
                            ",
                    ])->label(false) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <?= $form->field($model, 'section_id', ['inputTemplate' => '<label style="padding: 0; color: #555; font-weight: 600;">Section</label>{input}', 'inputOptions' => ['class' => 'form-control pva-form-control'] ])->dropDownList($listData3, ['id', 'section_name'])->label(false) ?>
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
                    <p></p>
                    <?php if(!$model->isNewRecord): ?>
                    <?= Html::a(Yii::t('app', 'View'),['view', 'id' => $model->id], ['class' => 'ui link fluid huge teal button']) ?>
                    <p></p>
                    <?php endif ?>
                    <?= Html::a(Yii::t('app', 'Cancel'),['/enroll'], ['class' => 'ui link fluid huge grey button']) ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>