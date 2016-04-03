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
$current_date = date('Y');
$school_year = SchoolYear::find()->orderBy(['id' => SORT_DESC])->all();
$section = Section::find()->all();
$grade_level = GradeLevel::find()->where(['!=', 'id', 0])->all();

$listData = ArrayHelper::map($grade_level, 'id' , 'name');
$listData2 = ArrayHelper::map($school_year, 'id' , 'sy');
$listData3 = ArrayHelper::map($section, 'id' , 'section_name');
$state = false;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="enrollment-form">
    <?php $form = ActiveForm::begin(); ?>
        <div class="row">
            <p></p>
            <div class="col-lg-2 col-md-2 col-12">
                <div class="form-group">
                    <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Save', ['class' => $model->isNewRecord ? 'btn btn-success btn-block' : 'btn btn-primary btn-block']) ?>
                    <?= Html::a(Yii::t('app', 'Cancel'), ['/enroll'], ['class' => 'btn btn-default btn-block']) ?>
                </div>
            </div>
            <div class="col-lg-7 col-md-7 col-12">
                <div id="enrollment-form-wrap" class="panel panel-default">
                    <div  class="panel-body">
                        <div class="container form-input-wrapper">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div id="enroll-profile-img-wrap">
                                        <img src="<?= Yii::$app->request->baseUrl . '/uploads/ui/user-blue.png' ?>" alt="student">
                                    </div>
                                    <?= $form->field($model, 'student_id')->widget(Select2::classname(), [
                                            'data' => ArrayHelper::map(StudentForm::find()->all(),'id', function($model){return $model->id . ' ' . $model->last_name . ', ' . $model->first_name . ' ' . $model->middle_name;}),
                                            'language' => 'en',
                                            'options' => ['id' => 'auto-suggest','placeholder' => 'Select Student'],
                                            'pluginOptions' => [
                                                'allowClear' => true
                                            ],
                                            'pluginEvents' => [
                                                'change' => "
                                                    function(){
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
                                        ])->label(false); 
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-12">
                <div id="enrollment-form-wrap" class="panel panel-default">
                    <div  class="panel-body">
                        <div class="container form-input-wrapper">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                        <?= $form->field($model, 'enrollment_status', ['inputTemplate' => '<div style="margin-top: -7px;"><label style="padding: 0; color: #555;"><strong>Enrolled</strong></label><div class="pull-right">{input}</div></div>'])->checkbox($options = ['class' => 'js-switch', 'data-switchery' => true, 'value' => $model->isNewRecord ? 1 : $model->enrollment_status])->label(false) ?>
                                        <?= $form->field($model, 'sy_id', ['inputTemplate' => '<div class="input-div-wrap"><label>School Year</label>{input}</div>', 'inputOptions' => ['class' => 'form-control pva-form-control']])->dropDownList($listData2, ['id', 'sy'])->label(false) ?>
                                        <?= $form->field($model, 'grade_level_id', ['inputTemplate' => '<div class="input-div-wrap"><label>Grade Level</label></label>{input}</div>', 'inputOptions' => ['class' => 'form-control pva-form-control']])->dropDownList($listData,
                                        [
                                            'onchange' => "
                                                $.post('". Yii::$app->urlManager->createUrl('enroll/section?id=') . "'+parseInt($('#enrolledform-grade_level_id').val()), function(data){
                                                    $('#enrolledform-section_id').find('option').remove();
                                                    $('#enrolledform-section_id').each(function(){
                                                        $(this).append(data);
                                                    });
                                                });
                                            ",
                                        ])->label(false) ?>
                                        <?= $form->field($model, 'section_id', ['inputTemplate' => '<div class="input-div-wrap" style="margin-bottom: 30px;"><label>Section</label></label>{input}</div>', 'inputOptions' => ['class' => 'form-control pva-form-control']])->dropDownList($listData3, ['id', 'section_name'])->label(false) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php ActiveForm::end(); ?>
</div>
<?php
$sw = <<< JS
$(document).ready(function(){
    var hash = '#';
    var blank = '';

    function syncValue(elem){
        if(elem.defaultValue !== elem.previousElementSibling.defaultValue){
            elem.previousElementSibling.defaultValue = elem.defaultValue;
        }
    }

    function changeState(elem){
        if(parseInt(elem.defaultValue) === 1){
            elem.checked = false;
            $(elem).attr('checked', false);
            elem.previousElementSibling.defaultValue = 1;
        } else {
            elem.checked = true;
            $(elem).attr('checked', true);
            elem.previousElementSibling.defaultValue = 0;
        }
    }
    
    if (Array.prototype.forEach) {
        var i = 0;
        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
        
        elems.forEach(function(html) {
            syncValue(elems[i]);
            changeState(elems[i]);
            var switchery = new Switchery(html, {size: 'small', speed: '0.2s'});

            elems[i].onchange = function() { 
                if(this.checked){
                    this.defaultValue = 0;
                    changeState(this);
                }else {
                    this.defaultValue = 1;
                    changeState(this);
                }
            };
            i++;
        });
    } else {
        var i = 0;
        var elems = document.querySelectorAll('.js-switch');

        for (i ; i < elems.length; i++) {
            syncValue(elems[i]);
            changeState(elems[i]);
            var switchery = new Switchery(elems[i], {size: 'small', speed: '0.2s'});

            elems[i].onchange = function() { 
                if(this.checked){
                    this.defaultValue = 0;
                    changeState(this);
                }else {
                    this.defaultValue = 1;
                    changeState(this);
                }
            };
        }
    }
});
JS;
$this->registerJs($sw);
?>