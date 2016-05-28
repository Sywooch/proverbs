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
            <div class="col-lg-9 col-md-9 col-12">
                <div id="enrollment-form-wrap" class="panel panel-default horizontal-stripe" style="border-top: 0;">
                    <div id="enroll-card" class="panel-body">
                        <div id="enroll-profile-img-wrap">
                            <div id="enroll-student-profile-image-bg" style="background: url('../uploads/ui/user-default.png'); background-size: contain;"></div>
                            <img id="enroll-student-profile-image" class="animated2 fastShrink hidden" src="../uploads/ui/user-blue.png" alt="student"  data-write="false">
                            <div id="enroll-profile-sped" class="hidden"><label for="SPED">SPED</label></div>
                        </div>
                        <div id="enroll-profile-write-wrap"><img src="<?= Yii::$app->request->baseUrl . '/uploads/ui/pencil.png' ?>" alt="write"></div>
                        <div class="container form-input-wrapper">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="text-centered">
                                        <h1 id="enroll-profile-name">&nbsp;</h1>
                                        <h4><p id="enroll-profile-nickname">&nbsp;</p></h4>
                                        <br>
                                    </div>
                                    <div id="enroll-profile-details" class="" style="text-align: left;">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <div class="enroll-profile-info-wrap">
                                                    <table>
                                                        <tr>
                                                            <td><span><img id="ui-profile-info-icon" src="<?= Yii::$app->request->baseUrl . '/uploads/ui/id.png' ?>" alt="id"></span></td>
                                                            <td><div id="enroll-profile-id"></div></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12">
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
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <div class="enroll-profile-info-wrap">
                                                    <table>
                                                        <tr>
                                                            <td><span><img id="ui-profile-info-icon" src="<?= Yii::$app->request->baseUrl . '/uploads/ui/birthday.png' ?>" alt="birthday"></span></td>
                                                            <td><div id="enroll-profile-birth"></div></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12">
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
                                    <div class="form-group">
                                        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Save', ['class' => $model->isNewRecord ? 'btn btn-success btn-block' : 'btn btn-primary btn-block']) ?>
                                        <?= Html::a(Yii::t('app', 'Cancel'), ['/enroll'], ['class' => 'btn btn-default btn-block']) ?>
                                    </div>
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
//$this->render('_js-update', ['student' => $student]);
//$this->render('_js-section');
$this->render('switch');
?>
