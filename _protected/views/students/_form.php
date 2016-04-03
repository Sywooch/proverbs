<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\jui\DatePicker;
use app\models\GradeLevel;
use yii\helpers\ArrayHelper;
$grade_level = GradeLevel::find()->all();
$listData = ArrayHelper::map($grade_level, 'id' , 'name');
$this->title = "New";
?>
<p></p>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
    <?php $form = ActiveForm::begin(); ?>
        <div class="col-lg-10 col-md-10 col-sm-12">
            <div class="row">
                <div class="tab-content" style="margin-bottom: 15px;">
                    <div role="tabpanel" class="tab-pane" id="step1" style="min-height: 300px;">
                        <div class="row">
                            <div id="student-profile-offset-bg">&nbsp;</div>
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <div id="student-profile-img-wrap">
                                    <img src="<?= Yii::$app->request->baseUrl . '/uploads/ui/user-blue.png' ?>" alt="student">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <p></p>
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="container form-input-wrapper">
                                    <div class="col-lg-12 col-md-12 col-sm-12" style="display: block;">
                                        <?= $model->isNewRecord ? '' : $form->field($model, 'id', ['inputTemplate' => '<div class="input-div-wrap"><label>Student ID</label>{input}</div>', 'inputOptions' => [] ])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <div class="col-lg-4 col-md-4 col-sm-12"><?= $form->field($model, 'first_name', ['inputTemplate' => '<div class="input-div-wrap"><label>First</label>{input}</div>','inputOptions' => [] ])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?></div>
                                <div class="col-lg-4 col-md-4 col-sm-12"><?= $form->field($model, 'middle_name', ['inputTemplate' => '<div class="input-div-wrap"><label>Middle</label>{input}</div>','inputOptions' => [] ])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?></div>
                                <div class="col-lg-4 col-md-4 col-sm-12"><?= $form->field($model, 'last_name', ['inputTemplate' => '<div class="input-div-wrap"><label>Surname</label>{input}</div>','inputOptions' => []] )->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-12">&nbsp;</div>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <div class="col-lg-4 col-md-4 col-sm-12"><?= $form->field($model, 'nickname', ['inputTemplate' => '<div class="input-div-wrap"><label>Nickname</label>{input}</div>','inputOptions' => []])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?></div>
                                <div class="col-lg-4 col-md-4 col-sm-12"><?= $form->field($model, 'gender', ['inputTemplate' => '<div class="input-div-wrap"><label>Gender</label>{input}</div>', 'inputOptions' => ['class' => 'form-control pva-form-control'] ])->dropDownList(['0' => 'Male', '1' => 'Female'])->label(false) ?></div>
                                <div class="col-lg-4 col-md-4 col-sm-12"><?= $form->field($model, 'grade_level_id', ['inputTemplate' => '<div class="input-div-wrap"><label>Grade Level</label>{input}</div>','inputOptions' => ['class' => 'form-control pva-form-control']])->dropDownList($listData, ['id', 'name'])->label(false) ?></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="container form-input-wrapper">
                                    <div class="col-lg-12 col-md-12 col-sm-12">&nbsp;</div>
                                </div>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <div class="col-lg-3 col-md-3 col-sm-12"><?= $form->field($model, 'birth_date', ['inputTemplate' => '<div class="input-div-wrap"><label>Birth Date</label>{input}</div>'])->label(false)->widget(DatePicker::className(),['options' => ['class' => 'form-control pva-form-control']] ) ?></div>
                                <div class="col-lg-7 col-md-7 col-sm-12"><?= $form->field($model, 'address', ['inputTemplate' => '<div class="input-div-wrap"><label>Address</label>{input}</div>','inputOptions' => []])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?></div>
                                <div class="col-lg-2 col-md-2 col-sm-12"><?= $form->field($model, 'zip_code', ['inputTemplate' => '<div class="input-div-wrap"><label>Zip Code</label>{input}</div>','inputOptions' => []])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="container form-input-wrapper">
                                    <div class="col-lg-12 col-md-12 col-sm-12">&nbsp;</div>
                                </div>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <div class="col-lg-4 col-md-4 col-sm-12"><?= $form->field($model, 'religion', ['inputTemplate' => '<div class="input-div-wrap"><label>Religion</label>{input}</div>','inputOptions' => [] ])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?></div>
                                <div class="col-lg-4 col-md-4 col-sm-12"><?= $form->field($model, 'citizenship', ['inputTemplate' => '<div class="input-div-wrap"><label>Citizenship</label>{input}</div>','inputOptions' => [] ])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="container form-input-wrapper">
                                    <div class="col-lg-12 col-md-12 col-sm-12">&nbsp;</div>
                                </div>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <div class="col-lg-4 col-md-4 col-sm-12"><?= $form->field($model, 'phone', ['inputTemplate' => '<div class="input-div-wrap"><label>Landline</label>{input}</div>','inputOptions' => [] ])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?></div>
                                <div class="col-lg-4 col-md-4 col-sm-12"><?= $form->field($model, 'mobile', ['inputTemplate' => '<div class="input-div-wrap"><label>Mobile</label>{input}</div>','inputOptions' => [] ])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?></div>
                            </div>
                        </div>
                    </div>

                    <div role="tabpanel" class="tab-pane active" id="step2">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <h4><strong>Parents Information</strong></h4>
                                <hr class="hr-form-separator">
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="container form-input-wrapper">
                                        <?= $form->field($model, 'fathers_name', ['inputTemplate' => '<div class="input-div-wrap"><label>Father\'s Name</label>{input}</div>','inputOptions' => [] ])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?>
                                        <?= $form->field($model, 'fathers_religion', ['inputTemplate' => '<div class="input-div-wrap"><label>Religion</label>{input}</div>','inputOptions' => [] ])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?>
                                        <?= $form->field($model, 'fathers_citizenship', ['inputTemplate' => '<div class="input-div-wrap"><label>Citizenship</label>{input}</div>','inputOptions' => [] ])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?>
                                        <?= $form->field($model, 'fathers_occupation', ['inputTemplate' => '<div class="input-div-wrap"><label>Occupation</label>{input}</div>','inputOptions' => [] ])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?>
                                        <?= $form->field($model, 'fathers_employer', ['inputTemplate' => '<div class="input-div-wrap"><label>Employer</label>{input}</div>','inputOptions' => [] ])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?>
                                        <?= $form->field($model, 'fathers_phone', ['inputTemplate' => '<div class="input-div-wrap"><label>Landline</label>{input}</div>','inputOptions' => [] ])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?>
                                        <?= $form->field($model, 'fathers_mobile', ['inputTemplate' => '<div class="input-div-wrap"><label>Mobile</label>{input}</div>','inputOptions' => [] ])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?>
                                        <?= $form->field($model, 'fathers_email', ['inputTemplate' => '<div class="input-div-wrap"><label>Email</label>{input}</div>','inputOptions' => [] ])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="container form-input-wrapper">
                                        <?= $form->field($model, 'mothers_name', ['inputTemplate' => '<div class="input-div-wrap"><label>Mother\'s Name</label>{input}</div>','inputOptions' => [] ])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?>
                                        <?= $form->field($model, 'mothers_religion', ['inputTemplate' => '<div class="input-div-wrap"><label>Religion</label>{input}</div>','inputOptions' => [] ])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?>
                                        <?= $form->field($model, 'mothers_citizenship', ['inputTemplate' => '<div class="input-div-wrap"><label>Citizenship</label>{input}</div>','inputOptions' => [] ])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?>
                                        <?= $form->field($model, 'mothers_occupation', ['inputTemplate' => '<div class="input-div-wrap"><label>Occupation</label>{input}</div>','inputOptions' => [] ])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?>
                                        <?= $form->field($model, 'mothers_employer', ['inputTemplate' => '<div class="input-div-wrap"><label>Employer</label>{input}</div>','inputOptions' => [] ])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?>
                                        <?= $form->field($model, 'mothers_phone', ['inputTemplate' => '<div class="input-div-wrap"><label>Landline</label>{input}</div>','inputOptions' => [] ])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?>
                                        <?= $form->field($model, 'mothers_mobile', ['inputTemplate' => '<div class="input-div-wrap"><label>Mobile</label>{input}</div>','inputOptions' => [] ])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?>
                                        <?= $form->field($model, 'mothers_email', ['inputTemplate' => '<div class="input-div-wrap"><label>Email</label>{input}</div>','inputOptions' => [] ])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="container form-input-wrapper">
                                        <?= $form->field($model, 'parents_are', ['inputTemplate' => '<div class="input-div-wrap"><label>Parents are </label>{input}</div>', 'inputOptions' => ['class' => 'form-control pva-form-control']])->dropDownList(['0' => 'Together', '1' => 'Separated', '2' => 'Widowed', '3' => 'Single', '4' => 'Marriage Anulled'], ['default' => 'Together'])->label(false) ?>
                                        <?= $form->field($model, 'student_is_living_with', ['inputTemplate' => '<div class="input-div-wrap"><label>Student is living with </label>{input}</div>', 'inputOptions' => ['class' => 'form-control pva-form-control']])->dropDownList(['0' => 'Both Parents', '1' => 'Father', '2' => 'Mother', '3' => 'Guardian'], ['default' => 'both Parents'])->label(false) ?>
                                        <div style="padding-bottom: 0px;">
                                            <label><strong>If Deceased</strong></label>
                                        </div>
                                            <?= $form->field($model, 'father_is', ['inputTemplate' => '<div style="margin-top: 0;"><label style="padding: 0; color: #555;"><strong>Father</strong></label><div class="pull-right">{input}</div></div>'])->checkbox($options = ['class' => 'js-switch', 'data-switchery' => true, 'value' => $model->isNewRecord ? 1 : $model->father_is])->label(false) ?>
                                            <?= $form->field($model, 'mother_is', ['inputTemplate' => '<div style="margin-top: 0;"><label style="padding: 0; color: #555;"><strong>Mother</strong></label><div class="pull-right">{input}</div></div>'])->checkbox($options = ['class' => 'js-switch', 'data-switchery' => true, 'value' => $model->isNewRecord ? 1 : $model->mother_is])->label(false) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div role="tabpanel" class="tab-pane" id="step3">
                        <h4><strong>Guardian</strong></h4>
                        <hr class="hr-form-separator">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="container form-input-wrapper">
                                        <?= $form->field($model, 'guardians_name', ['inputTemplate' => '<div class="input-div-wrap"><label>Guardian\'s Name</label>{input}</div>','inputOptions' => [] ])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?>
                                        <?= $form->field($model, 'guardians_occupation', ['inputTemplate' => '<div class="input-div-wrap"><label>Occupation</label>{input}</div>','inputOptions' => [] ])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?>
                                        <?= $form->field($model, 'guardians_phone', ['inputTemplate' => '<div class="input-div-wrap"><label>Landline</label>{input}</div>','inputOptions' => [] ])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?>
                                        <?= $form->field($model, 'guardians_mobile', ['inputTemplate' => '<div class="input-div-wrap"><label>Mobile</label>{input}</div>','inputOptions' => [] ])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-5 col-sm-12">
                                    <div class="container form-input-wrapper">
                                        <?= $form->field($model, 'guardians_address', ['inputTemplate' => '<div class="input-div-wrap"><label>Address</label>{input}</div>','inputOptions' => [] ])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?>
                                        <?= $form->field($model, 'guardians_employer', ['inputTemplate' => '<div class="input-div-wrap"><label>Employer</label>{input}</div>','inputOptions' => [] ])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12">
                                    <div class="container form-input-wrapper">
                                        <?= $form->field($model, 'guardians_relation_to_student', ['inputTemplate' => '<div class="input-div-wrap"><label>Relation</label>{input}</div>','inputOptions' => [] ])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div role="tabpanel" class="tab-pane" id="step4">
                        <h4><strong>Previous School</strong></h4>
                        <hr class="hr-form-separator">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="container form-input-wrapper">
                                        <?= $form->field($model, 'previous_school_name', ['inputTemplate' => '<div class="input-div-wrap"><label>Name of School</label>{input}</div>','inputOptions' => [] ])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?>
                                        <?= $form->field($model, 'previous_school_address', ['inputTemplate' => '<div class="input-div-wrap"><label>Address</label>{input}</div>','inputOptions' => [] ])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?>
                                        <?= $form->field($model, 'previous_school_description', ['inputTemplate' => '<div class="input-div-wrap"><label>Description</label>{input}</div>','inputOptions' => [] ])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?>
                                        <?= $form->field($model, 'previous_school_phone', ['inputTemplate' => '<div class="input-div-wrap"><label>Landline</label>{input}</div>','inputOptions' => [] ])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?>
                                        <?= $form->field($model, 'previous_school_mobile', ['inputTemplate' => '<div class="input-div-wrap"><label>Mobile</label>{input}</div>','inputOptions' => [] ])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?>                                    
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="container form-input-wrapper">
                                        <?= $form->field($model, 'previous_school_grade_level', ['inputTemplate' => '<div class="input-div-wrap"><label>Grade Level</label>{input}</div>','inputOptions' => ['class' => 'form-control pva-form-control']])->dropDownList($listData, ['id', 'name'])->label(false) ?>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-12"><?= $form->field($model, 'previous_school_from_school_year', ['inputTemplate' => '<div class="input-div-wrap"><label>From</label>{input}</div>','inputOptions' => [] ])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?></div>
                                            <div class="col-lg-6 col-md-6 col-sm-12"><?= $form->field($model, 'previous_school_to_school_year', ['inputTemplate' => '<div class="input-div-wrap"><label>To</label>{input}</div>','inputOptions' => [] ])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?></div>
                                        </div>
                                        <?= $form->field($model, 'previous_school_average_grade', ['inputTemplate' => '<div class="input-div-wrap"><label>Average Grade</label>{input}</div>','inputOptions' => [] ])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?>
                                        <?= $form->field($model, 'previous_school_teacher_in_charge', ['inputTemplate' => '<div class="input-div-wrap"><label>Teacher-in-charge</label>{input}</div>','inputOptions' => [] ])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?>
                                        <?= $form->field($model, 'previous_school_principal', ['inputTemplate' => '<div class="input-div-wrap"><label>Principal</label>{input}</div>','inputOptions' => [] ])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div role="tabpanel" class="tab-pane" id="step5">
                        <h4><strong>Requirements &amp; Additional Info</strong></h4>
                        <hr class="hr-form-separator">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="container form-input-wrapper">
                                    <div id="student-reqs" class="col-lg-12 col-md-12 col-sm-12">
                                        <?= $form->field($model, 'student_photo', ['inputTemplate' => '<div style="margin-top: 0;"><label style="padding: 0; color: #555;"><strong>Student\'s Photo</strong></label><div class="pull-right">{input}</div></div>'])->checkbox($options = ['class' => 'js-switch', 'data-switchery' => true, 'value' => $model->isNewRecord ? 1 : $model->student_photo])->label(false) ?>
                                        <?= $form->field($model, 'guardians_photo', ['inputTemplate' => '<div style="margin-top: 0;"><label style="padding: 0; color: #555;"><strong>Guardian\'s Photo</strong></label><div class="pull-right">{input}</div></div>'])->checkbox($options = ['class' => 'js-switch', 'data-switchery' => true, 'value' => $model->isNewRecord ? 1 : $model->guardians_photo])->label(false) ?>
                                        <?= $form->field($model, 'report_card', ['inputTemplate' => '<div style="margin-top: 0;"><label style="padding: 0; color: #555;"><strong>Birth Certificate</strong></label><div class="pull-right">{input}</div></div>'])->checkbox($options = ['class' => 'js-switch', 'data-switchery' => true, 'value' => $model->isNewRecord ? 1 : $model->report_card])->label(false) ?>
                                        <?= $form->field($model, 'birth_certificate', ['inputTemplate' => '<div style="margin-top: 0;"><label style="padding: 0; color: #555;"><strong>Report Card</strong></label><div class="pull-right">{input}</div></div>'])->checkbox($options = ['class' => 'js-switch', 'data-switchery' => true, 'value' => $model->isNewRecord ? 1 : $model->birth_certificate])->label(false) ?>
                                        <?= $form->field($model, 'good_moral', ['inputTemplate' => '<div style="margin-top: 0;"><label style="padding: 0; color: #555;"><strong>Good Moral</strong></label><div class="pull-right">{input}</div></div>'])->checkbox($options = ['class' => 'js-switch', 'data-switchery' => true, 'value' => $model->isNewRecord ? 1 : $model->good_moral])->label(false) ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="container form-input-wrapper">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <?= $form->field($model, 'status', ['inputTemplate' => '<div style="margin-top: 0;"><label style="padding: 0; color: #555;"><strong>Active</strong></label><div class="pull-right">{input}</div></div>'])->checkbox($options = ['class' => 'js-switch', 'data-switchery' => true, 'value' => $model->isNewRecord ? 1 : $model->status])->label(false) ?>
                                        <?= $form->field($model, 'student_has_sibling_enrolled', ['inputTemplate' => '<div style="margin-top: 0;"><label style="padding: 0; color: #555;"><strong>Siblings Enrolled</strong></label><div class="pull-right">{input}</div></div>'])->checkbox($options = ['class' => 'js-switch', 'data-switchery' => true, 'value' => $model->isNewRecord ? 1 : $model->student_has_sibling_enrolled])->label(false) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-12">
                <ul id="tablist" class="nav nav-tabs nav-stacked" role="tablist">
                    <li role="presentation" class="active"><a class="tablist-a" href="#step1" aria-controls="step1" role="tab" data-toggle="tab">Student</a></li>
                    <li role="presentation"><a class="tablist-a" href="#step2" aria-controls="step2" role="tab" data-toggle="tab">Parents</a></li>
                    <li role="presentation"><a class="tablist-a" href="#step3" aria-controls="step3" role="tab" data-toggle="tab">Guardian</a></li>
                    <li role="presentation"><a class="tablist-a" href="#step4" aria-controls="step4" role="tab" data-toggle="tab">Previous School</a></li>
                    <li role="presentation"><a class="tablist-a" href="#step5" aria-controls="step5" role="tab" data-toggle="tab">Requirements</a></li>
                </ul>
                <p>
                    <div class="form-group">
                       <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Save', ['class' => $model->isNewRecord ? 'btn btn-success btn-block' : 'btn btn-primary btn-block']) ?>
                       <?= Html::a(Yii::t('app', 'Cancel'), ['/students'], ['class' => 'btn btn-default btn-block']) ?>
                    </div>
                </p>
            </div>
        </div>
    <?php ActiveForm::end(); ?>
    </div>
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