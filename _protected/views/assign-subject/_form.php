<?php

use yii\web\View;
use yii\helpers\HtmlPurifier;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use app\models\GradeLevel;
use app\models\Section;
use app\models\Subject;
use app\models\LearningArea;
use app\models\TeacherForm;
use app\models\User;
use app\models\Card;
use app\models\Options;
use app\models\DataHelper;
use app\models\SchoolYear;
use nesbot\Carbon;

$current_date = date('Y');
$school_year = SchoolYear::find()->orderBy(['id' => SORT_DESC])->all();
$section = Section::find()->all();
$subject = Subject::find()->all();
$teacher = User::find()->join('LEFT JOIN','auth_assignment','auth_assignment.user_id = id')->where(['auth_assignment.item_name' => 'teacher'])->all();
//$teacher = User::find()->joinWith('role')->where(['item_name' => 'teacher'])->all();
$grade_level = GradeLevel::find()->all();

$sy_list = ArrayHelper::map($school_year, 'id' , 'sy');
$teacher_list = ArrayHelper::map($teacher, 'id' , 'last_name');
$grade_level_list = ArrayHelper::map($grade_level, 'id' , 'name');
$section_list = ArrayHelper::map($section, 'id' , 'section_name');
$subject_list = ArrayHelper::map($subject, 'id' , 'subject_name');
$card_url = json_encode(Yii::$app->request->baseUrl . '/site/tcard?data=');
$this->title = 'New';
?>
<br>
<?php $form = ActiveForm::begin(['class' => 'ui loading form']); ?>
<div class="ui three column stackable grid">
    <div class="four wide rounded column">
        <?= Card::render($options = [
            'imageContent' => !$model->isNewRecord ? !empty($model->teacher->profile_image) ? ['/file', 'id' => $model->teacher->profile_image] : Yii::$app->params['avatar'] : Yii::$app->request->baseUrl . Yii::$app->params['avatar'],
            'labelContent' => !$model->isNewRecord ? implode(' ', ['ID#', '<strong>', $model->teacher->id, '</strong>']) : '&nbsp;',
            'labelFor' => 'Teacher ID',
            'labelOptions' => '',
            'headerContent' => !$model->isNewRecord ? DataHelper::name($model->teacher->first_name, $model->teacher->middle_name, $model->teacher->last_name) : '&nbsp;',
            'headerOptions' => '',
            'metaContent' => !$model->isNewRecord ? implode('', ['\'', $model->teacher->username, '\'']) : '&nbsp',
            'metaOptions' => '',
            'leftFloatedContent' => !$model->isNewRecord ? implode('', [DataHelper::gradeLevel($model->grade_level_id),'<p style="color: rgba(0,0,0,.4);"><span style="font-size: 11px;">', DataHelper::schoolYear($model->sy_id),'</span><br/>Adviser', '</p>']) : '&nbsp;',
            'leftFloatedFor' => '',
            'leftFloatedOptions' => '',
            'rightFloatedContent' => '',
            'rightFloatedOptions' => 'hidden'
        ]) ?>
    </div>
    <div class="nine wide rounded column">
        <div class="ui segment">
            <?= !$model->isNewRecord ? Html::tag('label',implode('', [implode('-', array_map('ucfirst', explode('-', Yii::$app->controller->id))),'# ', $model->id]), ['class' => 'ui fluid big label']) : '' ?>
            <br><br>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <?= $form->field($model, 'sy_id', ['inputTemplate' => '<label>School Year</label>{input}'])->dropDownList(ArrayHelper::map(SchoolYear::find()->orderBy(['id' => SORT_DESC])->all(),'id','sy'), ['class' => 'form-control pva-form-control'])->label(false)?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <?= $form->field($model, 'teacher_id')->widget(Select2::classname(), [
                            'data' => ArrayHelper::map(app\models\User::find()
                                        ->joinWith('role')
                                        ->where(['item_name' => 'teacher'])
                                        ->orderBy(['first_name' => SORT_ASC])
                                        ->all(), 'id',
                                            function($model){
                                                if($model->first_name === ''){
                                                    return $model->username;
                                                }else {
                                                    return implode(' ', [$model->first_name, $model->middle_name, $model->last_name]);
                                                }
                                            }
                                        ),
                            'language' => 'en',
                            'options' => ['id' => 'auto-suggest','placeholder' => 'Select Teacher'],
                            'pluginOptions' => [
                                'allowClear' => true,
                            ],
                            'pluginEvents' => [
                                'change' => "
                                    function(){
                                        if($('#auto-suggest').val() === ''){
                                            console.log('empty');
                                            $('.tiny.image').attr('src', '/proverbs/uploads/ui/user-blue.svg');
                                            $('#header-label').html('&nbsp;');
                                            $('#header-content').html('&nbsp;');
                                            $('#meta-content').html('&nbsp;');
                                            $('#left-content').html('&nbsp;');
                                            $('#right-content').addClass('hidden');
                                        }else {
                                            $.ajax({
                                                type: 'POST',
                                                url: $card_url + JSON.stringify({uid:$('#auto-suggest').val(),}),
                                                contentType: 'application/json; charset=utf-8',
                                                dataType: 'json',
                                                success: function(data){
                                                    $('#header-label').html('<em>' + data.email + '</em>');
                                                    $('#header-content').html(data.name);
                                                    $('#meta-content').html(data.username);

                                                    if(data.img !== 'empty'){
                                                        $('.tiny.image').attr('src', data.img);
                                                    }else {
                                                        $('.tiny.image').attr('src', '/proverbs/uploads/ui/user-blue.svg');
                                                    }
                                                }
                                            });
                                        }
                                    }
                                ",
                            ],
                        ])->label(false) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <?= $form->field($model, 'grade_level_id', ['inputTemplate' => '<label style="padding: 0; color: #555; font-weight: 600;">Grade Level</label>{input}', 'inputOptions' => ['class' => 'form-control pva-form-control'] ])
                        ->dropDownList(ArrayHelper::map(GradeLevel::find()->all(), 'id' , 'name'),['class' => 'form-control pva-form-control',
                        'onchange'=>'
                            $.post( "'. Yii::$app->urlManager->createUrl('assign-subject/lists?id=') . '"+$(this).val(), function( data ) {
                            console.log(data);
                            $( "select#assignedform-subject_id" ).html(data);
                                $.post( "'. Yii::$app->urlManager->createUrl('assign-subject/section?id=') . '"+parseInt($("#assignedform-grade_level_id").val()), function( data ) {
                                    $("#assignedform-section_id").find("option").remove();
                                    $("#assignedform-section_id").each(function(){
                                    $(this).append(data);
                                });
                            });
                        })',
                    ]
                        )->label(false) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-12 col-sm-12">
                    <?= $form->field($model, 'section_id', ['inputTemplate' => '<label style="padding: 0; color: #555; font-weight: 600;">Grade Level</label>{input}', 'inputOptions' => ['class' => 'form-control pva-form-control'] ])->dropDownList(ArrayHelper::map(Section::find()->all(), 'id' , 'section_name'), ['id', 'section_name'])->label(false) ?>
                </div>
            </div>
        </div>
    </div>
    <div class="three wide rounded column">
        <div class="column">
            <?= Options::render(['scenario' => Yii::$app->controller->action->id, 'id' => $model->id, 'exist' => false]); ?>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>
