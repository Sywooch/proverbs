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
            <p><p>
            <div class="col-lg-3 col-md-3 col-12">
                <div id="enroll-profile-img-wrap">
                    <div id="enroll-student-profile-image-bg" style="background: url('../uploads/ui/user-default.png');"></div>
                    <img id="enroll-student-profile-image" class="animated2 fastShrink hidden" src="../uploads/ui/user-blue.png" alt="student"  data-write="false">
                </div>
                <p style="min-height: 15px;"></p>
            </div>
            <div class="col-lg-4 col-md-4 col-12">
                <div id="enrollment-form-wrap" class="panel panel-default horizontal-stripe" style="border-top: 0;">
                    <div id="enroll-card" class="panel-body">
                        <div id="enroll-profile-write-wrap"><img src="<?= Yii::$app->request->baseUrl . '/uploads/ui/pencil.png' ?>" alt="write"></div>
                        <div class="container form-input-wrapper">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="text-centered">
                                        <h1 id="enroll-profile-name">&nbsp;</h1>
                                        <h4><p id="enroll-profile-nickname">&nbsp;</p></h4>
                                        <br>
                                    </div>
                                    <div id="enroll-profile-details" class="hidden" style="text-align: left;">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                    <div class="enroll-profile-info-wrap">
                                                        <table>
                                                            <tr>
                                                                <td><span><img id="ui-profile-info-icon" src="<?= Yii::$app->request->baseUrl . '/uploads/ui/id.png' ?>" alt="id"></span></td>
                                                                <td><div id="enroll-profile-id"></div></td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <div class="col-lg-10 col-md-10 col-sm-12">
                                                    <div class="enroll-profile-info-wrap">
                                                        <table>
                                                            <tr>
                                                                <td><span><img id="ui-profile-info-icon" src="<?= Yii::$app->request->baseUrl . '/uploads/ui/birthday.png' ?>" alt="birthday"></span></td>
                                                                <td><div id="enroll-profile-birth"></div></td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <div class="col-lg-10 col-md-10 col-sm-12">
                                                    <div class="enroll-profile-info-wrap">
                                                        <table>
                                                            <tr>
                                                                <td><span><img id="ui-profile-info-icon" src="<?= Yii::$app->request->baseUrl . '/uploads/ui/age.png' ?>" alt="age"></span></td>
                                                                <td><div id="enroll-profile-age"></div></td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <div class="col-lg-10 col-md-10 col-sm-12">
                                                    <div class="enroll-profile-info-wrap">
                                                        <table>
                                                            <tr>
                                                                <td><span><img id="ui-profile-info-icon" src="<?= Yii::$app->request->baseUrl . '/uploads/ui/map-marker.png' ?>" alt="map"></span></td>
                                                                <td><div id="enroll-profile-address"></div></td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div id="enroll-profile-sped-row" class="hidden">
                                                    <div class="col-lg-5 col-md-5 col-sm-12">
                                                        <div class="enroll-profile-info-wrap">
                                                            <table>
                                                                <tr>
                                                                    <td><span><img id="ui-profile-info-icon" src="<?= Yii::$app->request->baseUrl . '/uploads/ui/paste-special.png' ?>" alt="sped"></span></td>
                                                                    <td><div id="enroll-profile-sped"></div></td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-12">
                <div class="panel panel-default">
                    <div  class="panel-body">
                        <div class="container form-input-wrapper">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                        <?= $form->field($model, 'student_id')->widget(Select2::classname(), [
                                                'data' => ArrayHelper::map(StudentForm::find()->orderBy(['first_name' => SORT_ASC])->all(),'id', function($model){ return implode(' ', [$model->first_name, $model->middle_name, $model->last_name]);}),
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
                                        <?= $form->field($model, 'enrollment_status', ['inputTemplate' => '<div style="margin-top: 2px;"><label style="padding: 0; color: #555;"><strong>Enrolled</strong></label><div class="pull-right">{input}</div></div>'])->checkbox($options = ['class' => 'js-switch', 'data-switchery' => true, 'value' => $model->isNewRecord ? 1 : $model->enrollment_status])->label(false) ?>
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
            <div class="col-lg-2 col-md-2 col-12">
                <div class="form-group">
                    <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Save', ['class' => $model->isNewRecord ? 'btn btn-success btn-block' : 'btn btn-primary btn-block']) ?>
                    <?= Html::a(Yii::t('app', 'Cancel'), ['/enroll'], ['class' => 'btn btn-default btn-block']) ?>
                </div>
            </div>
        </div>
    <?php ActiveForm::end(); ?>
</div>
<?php
if(!$model->isNewRecord) $this->registerJs("$('#enroll-profile-name').html('<a href=\"#\">'+ $('#select2-auto-suggest-container').attr('title') + '</a>');");
$st = <<< JS
$(document).ready(function(){
    var nme = "";
    var sid = 0;
    var ssid = $('#enroll-profile-id');
    var sname = $('#enroll-profile-name');
    var snick = $('#enroll-profile-nickname');
    var saddr = $('#enroll-profile-address');
    var sbirth = $('#enroll-profile-birth');
    var sage = $('#enroll-profile-age');
    var srow = $('#enroll-profile-sped-row');
    var sinfo = $('#enroll-profile-details');
    var ssped = $('#enroll-profile-sped');
    var simg = $('#enroll-student-profile-image');

    function clear(){
        ssid.html('');
        sname.html('&nbsp;');
        snick.html('&nbsp;');
        saddr.html('&nbsp;');
        sbirth.html('&nbsp;');
        sage.html('&nbsp;');
        ssped.html('&nbsp;');
        sinfo.addClass('hidden');      
        srow.addClass('hidden');
    }

    $("#auto-suggest").change(function () {
        var nme = $('#select2-auto-suggest-container').attr('title');
        var sid = parseInt($(this).find("option:contains(" + nme +")").val());
        var clr = $('#select2-auto-suggest-container');
        
        sinfo.removeClass('hidden');

        if($(clr[0].lastElementChild).text() !== 'Select Student'){
            $.ajax({
                type: "POST",
                url: "card?data=" + JSON.stringify({
                        sid: sid
                    }),
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                success: function(data) {
                    r(data);
                }
            });
        } else {
            clear();
            simg.attr('data-write', false);
            setE();
        }

        function r(data){
            ssid.html('ID#: ' + '<strong>' + data.sid + '</strong>');
            sname.html('<a href="' + data.sid + '">' + data.name + '</a>');
            snick.html("'" + data.nick + "'");
            saddr.html(data.addr);
            sbirth.html(data.bday);

            img(data);

            if(data.spd === 0) {
                srow.removeClass('hidden');
                ssped.html('SPED');
            } else {
                srow.addClass('hidden');
            }

            if(data.age === 0 || data.age === 1) {
                sage.html(data.age + ' year old');
            } else {
                sage.html(data.age + ' years old');
            }
        }

        function img(data){
            if(data.img === 'empty'){
                setJ();
                setTimeout(function(){ 
                    setD();
                    simg.attr('data-write', false);
                }, 300);

            } else {
                if(simg.attr('data-write') === 'false'){
                    setJ();
                    setTimeout(function(){ 
                        setI(data);
                    }, 300);
                }else {
                    setJ();
                    setTimeout(function(){ 
                        setI(data);
                    }, 300);
                }
            }
        }

        function setD(){
            simg.attr('src', '../uploads/ui/user-blue.png');
            simg.addClass('grow').removeClass('fastShrink').removeClass('hidden');
        }

        function setE(){
            simg.addClass('fastShrink').removeClass('grow');
        }

        function setI(data){
            simg.attr('data-write', true);
            simg.attr('src', data.img);
            simg.addClass('grow').removeClass('fastShrink').removeClass('hidden');
        }

        function setJ(){
            simg.removeClass('grow').addClass('fastShrink');
        }
    });
});
JS;

$this->registerJs($st);
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