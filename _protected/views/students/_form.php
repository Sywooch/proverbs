<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\jui\DatePicker;
use app\models\GradeLevel;
use yii\helpers\ArrayHelper;

$grade_level = GradeLevel::find()->all();
$listData = ArrayHelper::map($grade_level, 'id' , 'name');
?>
<div class="applicant-form">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <!-- <div class="progress">
                <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: 25%;">
                    <span class="sr-only"></span>
                </div>
            </div> -->
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12">
            <ul id="tablist" class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#step1" aria-controls="step1" role="tab" data-toggle="tab">Student Information</a></li>
                <li role="presentation"><a href="#step2" aria-controls="step2" role="tab" data-toggle="tab">Parents Information</a></li>
                <li role="presentation"><a href="#step3" aria-controls="step3" role="tab" data-toggle="tab">In case of Emergency</a></li>
                <li role="presentation"><a href="#step4" aria-controls="step4" role="tab" data-toggle="tab">Previous School</a></li>
                <li role="presentation"><a href="#step5" aria-controls="step5" role="tab" data-toggle="tab">Requirements</a></li>
            </ul>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12">
            <?php $form = ActiveForm::begin(); ?>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="step1">
                        <div class="row">
                            <div class="container form-input-wrapper">
                                <?= $model->isNewRecord ? '' : '<div class="col-lg-3 col-md-3 col-sm-12">' . $form->field($model, 'id', ['inputTemplate' => '<div class="input-group"><span class="input-group-addon"><span class="dropdown-list">ID</span></span></span>{input}</div>'])->label(false) . '</div>' ?>
                                <div class="col-lg-3 col-md-3 col-sm-12"><?= $form->field($model, 'status', ['inputTemplate' => '<div class="input-group"><span class="input-group-addon"><span class="dropdown-list">Status</span></span></span>{input}</div>'])->dropDownList(['0' => 'Inactive', '1' => 'Active'], ['default' => 'Active'])->label(false) ?></div>
                                <div class="col-lg-3 col-md-3 col-sm-12"><?= $form->field($model, 'grade_level_id', ['inputTemplate' => '<div class="input-group"><span class="input-group-addon"><span class="dropdown-list">Grade Level</span></span></span>{input}</div>'])->dropDownList($listData, ['id', 'name'])->label(false) ?></div>
                                <div class="col-lg-3 col-md-3 col-sm-12"><?= $form->field($model, 'student_has_sibling_enrolled', ['inputTemplate' => '<div class="input-group"><span class="input-group-addon"><span class="dropdown-list">Has Sibling Enrolled</span></span></span>{input}</div>'])->dropDownList(['0' => 'No', '1' => 'Yes'], ['default' => 'No'])->label(false) ?></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="container form-input-wrapper">
                                <div class="col-lg-4 col-md-3 col-sm-`2"><?= $form->field($model, 'first_name', ['inputTemplate' => '<div class="input-group"><span class="input-group-addon"><i class="fa fa-user fa-one-point-five"></i></span></span>{input}</div>','inputOptions' => ['placeholder' => 'First Name']])->label(false)->textInput(['class' => 'form-control'], ['maxlength' => true]) ?></div>
                                <div class="col-lg-4 col-md-3 col-sm-12"><?= $form->field($model, 'middle_name', ['inputTemplate' => '{input}', 'inputOptions' => ['placeholder' => 'Middle']])->label(false)->textInput(['class' => 'form-control'], ['maxlength' => true])->textInput(['maxlength' => true]) ?></div>
                                <div class="col-lg-4 col-md-3 col-sm-12"><?= $form->field($model, 'last_name', ['inputTemplate' => '{input}', 'inputOptions' => ['placeholder' => 'Last Name']])->label(false)->textInput(['class' => 'form-control'], ['maxlength' => true])->textInput(['maxlength' => true]) ?></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="container form-input-wrapper">
                                <div class="col-lg-3 col-md-3 col-sm-12"><?= $form->field($model, 'nickname', ['inputTemplate' => '{input}', 'inputOptions' => ['placeholder' => 'Nickname']])->label(false)->textInput(['class' => 'form-control'], ['maxlength' => true])->textInput(['maxlength' => true]) ?></div>
                                <div class="col-lg-2 col-md-2 col-sm-12"><?= $form->field($model, 'gender', ['inputTemplate' => '<div class="input-group"><span class="input-group-addon"><i class="fa fa-venus-mars fa-one-point-five"></i></span></span>{input}</div>'])->dropDownList(['0' => 'Male', '1' => 'Female'])->label(false) ?></div>
                                <div class="col-lg-3 col-md-3 col-sm-12"><?= $form->field($model, 'birth_date', ['inputTemplate' => '<div class="input-group">{input}<span class="input-group-addon"><i class="fa fa-calendar fa-one-point-five"></i></span></span></div>', 'inputOptions' => ['placeholder' => 'Birthday']])->label(false)->widget(DatePicker::className(),['options' => ['class' => 'form-control', 'placeholder' =>  'Date of Birth']] )?></div>
                                <div class="col-lg-4 col-md-4 col-sm-12"><?= $form->field($model, 'religion', ['inputTemplate' => '{input}', 'inputOptions' => ['placeholder' => 'Religion']])->label(false)->textInput(['maxlength' => true]) ?></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="container form-input-wrapper">
                                <div class="col-lg-3 col-md-3 col-sm-12"><?= $form->field($model, 'citizenship', ['inputTemplate' => '{input}' , 'inputOptions' => ['placeholder' => 'Citizenship']])->label(false)->textInput(['maxlength' => true]) ?></div>
                                <div class="col-lg-7 col-md-7 col-sm-12"><?= $form->field($model, 'address',['inputTemplate' => '<div class="input-group"><span class="input-group-addon"><i class="fa fa-home fa-one-point-five"></i></span></span>{input}</div>', 'inputOptions' => ['placeholder' => 'Home Address']])->label(false)->textInput(['maxlength' => true]) ?></div>
                                <div class="col-lg-2 col-md-2 col-sm-12"><?= $form->field($model, 'zip_code',['inputTemplate' => '{input}', 'inputOptions' => ['placeholder' => 'Zip Code']])->label(false)->textInput() ?></div>
                            </div>
                        </div> 
                        <div class="row">
                            <div class="container form-input-wrapper">
                                <div class="col-lg-3 col-md-3 col-sm-12"><?= $form->field($model, 'phone', ['inputTemplate' => '<div class="input-group"><span class="input-group-addon"><i class="fa fa-phone fa-one-point-five"></i></span></span>{input}</div>','inputOptions' => ['placeholder' => 'Tel. No.']])->label(false) ?></div>
                                <div class="col-lg-3 col-md-3 col-sm-12"><?= $form->field($model, 'mobile', ['inputTemplate' => '<div class="input-group"><span class="input-group-addon"><i class="fa fa-mobile fa-one-point-five"></i></span></span>{input}</div>','inputOptions' => ['placeholder' => 'Mobile']])->label(false) ?></div>
                            </div>
                        </div>
                    </div>

                    <div role="tabpanel" class="tab-pane" id="step2">
                        <div class="row">
                            <div class="container form-input-wrapper">
                                <div class="col-lg-6 col-md-6 col-sm-12"><?= $form->field($model, 'fathers_name', ['inputTemplate' => '<div class="input-group"><span class="input-group-addon"><i class="fa fa-user fa-one-point-five"></i></span></span>{input}</div>', 'inputOptions' => ['placeholder' => 'Fathers Full Name']])->textInput(['maxlength' => true])->label(false) ?></div>
                                <div class="col-lg-3 col-md-3 col-sm-12"><?= $form->field($model, 'fathers_phone', ['inputTemplate' => '<div class="input-group"><span class="input-group-addon"><i class="fa fa-phone fa-one-point-five"></i></span></span>{input}</div>', 'inputOptions' => ['placeholder' => 'Tel. No.']])->textInput(['maxlength' => true])->label(false) ?></div>
                                <div class="col-lg-3 col-md-3 col-sm-12"><?= $form->field($model, 'fathers_mobile', ['inputTemplate' => '<div class="input-group"><span class="input-group-addon"><i class="fa fa-mobile fa-one-point-five"></i></span></span>{input}</div>', 'inputOptions' => ['placeholder' => 'Mobile']])->textInput(['maxlength' => true])->label(false) ?></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="container form-input-wrapper">
                                <div class="col-lg-3 col-md-3 col-sm-12"><?= $form->field($model, 'fathers_citizenship', ['inputTemplate' => '{input}', 'inputOptions' => ['placeholder' => 'Citizenship']])->textInput(['maxlength' => true])->label(false) ?></div>
                                <div class="col-lg-3 col-md-3 col-sm-12"><?= $form->field($model, 'fathers_religion', ['inputTemplate' => '{input}', 'inputOptions' => ['placeholder' => 'Religion']])->textInput(['maxlength' => true])->label(false) ?></div>
                                <div class="col-lg-3 col-md-3 col-sm-12"><?= $form->field($model, 'fathers_occupation', ['inputTemplate' => '<div class="input-group"><span class="input-group-addon"><i class="fa fa-briefcase fa-one-point-five"></i></span></span>{input}</div>', 'inputOptions' => ['placeholder' => 'Occupation']])->textInput(['maxlength' => true])->label(false) ?></div>
                                <div class="col-lg-3 col-md-3 col-sm-12"><?= $form->field($model, 'fathers_employer', ['inputTemplate' => '<div class="input-group"><span class="input-group-addon"><i class="fa fa-building fa-one-point-five"></i></span></span>{input}</div>', 'inputOptions' => ['placeholder' => 'Employer']])->textInput(['maxlength' => true])->label(false) ?></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="container form-input-wrapper">
                                <div class="col-lg-6 col-md-6 col-sm-12"><?= $form->field($model, 'fathers_email', ['inputTemplate' => '<div class="input-group"><span class="input-group-addon"><i class="fa fa-envelope fa-one-point-five"></i></span></span>{input}</div>', 'inputOptions' => ['placeholder' => 'Email']])->textInput(['maxlength' => true])->label(false) ?></div>
                                <div class="col-lg-3 col-md-3 col-sm-12"><?= $form->field($model, 'father_is', ['inputTemplate' => '<div class="input-group"><span class="input-group-addon"><span class="dropdown-list">Father</span></span></span>{input}</div>'])->dropDownList(['0' => 'Still Lives', '1' => 'Is Deceased'], ['default' => 'Still Lives'])->label(false) ?></div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="container form-input-wrapper">
                                <div class="col-lg-6 col-md-6 col-sm-12"><?= $form->field($model, 'mothers_name', ['inputTemplate' => '<div class="input-group"><span class="input-group-addon"><i class="fa fa-user fa-one-point-five"></i></span></span>{input}</div>', 'inputOptions' => ['placeholder' => 'Mothers Full Name']])->textInput(['maxlength' => true])->label(false) ?></div>
                                <div class="col-lg-3 col-md-3 col-sm-12"><?= $form->field($model, 'mothers_phone', ['inputTemplate' => '<div class="input-group"><span class="input-group-addon"><i class="fa fa-phone fa-one-point-five"></i></span></span>{input}</div>', 'inputOptions' => ['placeholder' => 'Tel. No.']])->textInput(['maxlength' => true])->label(false) ?></div>
                                <div class="col-lg-3 col-md-3 col-sm-12"><?= $form->field($model, 'mothers_mobile', ['inputTemplate' => '<div class="input-group"><span class="input-group-addon"><i class="fa fa-mobile fa-one-point-five"></i></span></span>{input}</div>', 'inputOptions' => ['placeholder' => 'Mobile']])->textInput(['maxlength' => true])->label(false) ?></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="container form-input-wrapper">
                                <div class="col-lg-3 col-md-3 col-sm-12"><?= $form->field($model, 'mothers_citizenship', ['inputTemplate' => '{input}', 'inputOptions' => ['placeholder' => 'Citizenship']])->textInput(['maxlength' => true])->label(false) ?></div>
                                <div class="col-lg-3 col-md-3 col-sm-12"><?= $form->field($model, 'mothers_religion', ['inputTemplate' => '{input}', 'inputOptions' => ['placeholder' => 'Religion']])->textInput(['maxlength' => true])->label(false) ?></div>
                                <div class="col-lg-3 col-md-3 col-sm-12"><?= $form->field($model, 'mothers_occupation', ['inputTemplate' => '<div class="input-group"><span class="input-group-addon"><i class="fa fa-briefcase fa-one-point-five"></i></span></span>{input}</div>', 'inputOptions' => ['placeholder' => 'Occupation']])->textInput(['maxlength' => true])->label(false) ?></div>
                                <div class="col-lg-3 col-md-3 col-sm-12"><?= $form->field($model, 'mothers_employer', ['inputTemplate' => '<div class="input-group"><span class="input-group-addon"><i class="fa fa-building fa-one-point-five"></i></span></span>{input}</div>', 'inputOptions' => ['placeholder' => 'Employer']])->textInput(['maxlength' => true])->label(false) ?></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="container form-input-wrapper">
                                <div class="col-lg-6 col-md-6 col-sm-12"><?= $form->field($model, 'mothers_email', ['inputTemplate' => '<div class="input-group"><span class="input-group-addon"><i class="fa fa-envelope fa-one-point-five"></i></span></span>{input}</div>', 'inputOptions' => ['placeholder' => 'Email']])->textInput(['maxlength' => true])->label(false) ?></div>
                                <div class="col-lg-3 col-md-3 col-sm-12"><?= $form->field($model, 'mother_is', ['inputTemplate' => '<div class="input-group"><span class="input-group-addon"><span class="dropdown-list">Mother</span></span></span>{input}</div>'])->dropDownList(['0' => 'Still Lives', '1' => 'Is Deceased'], ['default' => 'Still Lives'])->label(false) ?></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="container form-input-wrapper">   
                                <div class="col-lg-3 col-md-3 col-sm-12"><?= $form->field($model, 'parents_are', ['inputTemplate' => '<div class="input-group"><span class="input-group-addon"><span class="dropdown-list">Parents are</span></span></span>{input}</div>'])->dropDownList(['0' => 'Together', '1' => 'Separated', '2' => 'Widowed', '3' => 'Single', '4' => 'Marriage Anulled'], ['default' => 'Together'])->label(false) ?></div>
                                <div class="col-lg-4 col-md-4 col-sm-12"><?= $form->field($model, 'student_is_living_with', ['inputTemplate' => '<div class="input-group"><span class="input-group-addon"><span class="dropdown-list">Student is living with</span></span></span>{input}</div>'])->dropDownList(['0' => 'Both Parents', '1' => 'Father', '2' => 'Mother', '3' => 'Guardian'], ['default' => 'Both Parents'])->label(false) ?></div>
                            </div>
                        </div>
                    </div>
                    
                    <div role="tabpanel" class="tab-pane" id="step3">
                        <div class="row">
                            <div class="container form-input-wrapper">
                                <div class="col-lg-6 col-md-6 col-sm-12"><?= $form->field($model, 'guardians_name', ['inputTemplate' => '<div class="input-group"><span class="input-group-addon"><i class="fa fa-user fa-one-point-five"></i></span></span>{input}</div>','inputOptions' => ['placeholder' => 'Guardians Full Name']])->label(false)->textInput(['maxlength' => true]) ?></div>
                                <div class="col-lg-3 col-md-3 col-sm-12"><?= $form->field($model, 'guardians_phone', ['inputTemplate' => '<div class="input-group"><span class="input-group-addon"><i class="fa fa-phone fa-one-point-five"></i></span></span>{input}</div>','inputOptions' => ['placeholder' => 'Tel. No.']])->label(false)->textInput(['maxlength' => true]) ?></div>
                                <div class="col-lg-3 col-md-3 col-sm-12"><?= $form->field($model, 'guardians_mobile', ['inputTemplate' => '<div class="input-group"><span class="input-group-addon"><i class="fa fa-mobile fa-one-point-five"></i></span></span>{input}</div>','inputOptions' => ['placeholder' => 'Mobile']])->label(false)->textInput(['maxlength' => true]) ?></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="container form-input-wrapper">
                                <div class="col-lg-4 col-md-4 col-sm-12"><?= $form->field($model, 'guardians_relation_to_student', ['inputTemplate' => '<div class="input-group"><span class="input-group-addon"><i class="fa fa-group fa-one-point-five"></i></span></span>{input}</div>','inputOptions' => ['placeholder' => 'Relation to Student']])->label(false)->textInput(['maxlength' => true]) ?></div>
                                <div class="col-lg-8 col-md-8 col-sm-12"><?= $form->field($model, 'guardians_address', ['inputTemplate' => '<div class="input-group"><span class="input-group-addon"><i class="fa fa-home fa-one-point-five"></i></span></span>{input}</div>','inputOptions' => ['placeholder' => 'Home Address']])->label(false)->textInput(['maxlength' => true]) ?></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="container form-input-wrapper">
                                <div class="col-lg-3 col-md-3 col-sm-12"><?= $form->field($model, 'guardians_occupation', ['inputTemplate' => '<div class="input-group"><span class="input-group-addon"><i class="fa fa-briefcase fa-one-point-five"></i></span></span>{input}</div>','inputOptions' => ['placeholder' => 'Occupation']])->label(false)->textInput(['maxlength' => true]) ?></div>
                                <div class="col-lg-4 col-md-4 col-sm-12"><?= $form->field($model, 'guardians_employer', ['inputTemplate' => '<div class="input-group"><span class="input-group-addon"><i class="fa fa-building fa-one-point-five"></i></span></span>{input}</div>','inputOptions' => ['placeholder' => 'Employer']])->label(false)->textInput(['maxlength' => true]) ?></div>
                            </div>
                        </div>
                    </div>

                    <div role="tabpanel" class="tab-pane" id="step4">
                        <div class="row">
                            <div class="container form-input-wrapper">
                                <div class="col-lg-3 col-md-3 col-sm-12"><?= $form->field($model, 'previous_school_grade_level', ['inputTemplate' => '<div class="input-group"><span class="input-group-addon"><span class="dropdown-list">Grade Level</span></span></span>{input}</div>'])->dropDownList($listData, ['id', 'name'])->label(false) ?></div>
                                <div class="col-lg-2 col-md-2 col-sm-12"><?= $form->field($model, 'previous_school_average_grade', ['inputTemplate' => '{input}','inputOptions' => ['placeholder' => 'Average Grade']])->label(false)->textInput() ?></div>
                                <div class="col-lg-2 col-md-2 col-sm-12"><?= $form->field($model, 'from_school_year', ['inputTemplate' => '{input}','inputOptions' => ['placeholder' => 'From School Year']])->label(false)->textInput() ?></div>
                                <div class="col-lg-2 col-md-2 col-sm-12"><?= $form->field($model, 'to_school_year', ['inputTemplate' => '{input}','inputOptions' => ['placeholder' => 'To School Year']])->label(false)->textInput() ?></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="container form-input-wrapper">
                                <div class="col-lg-6 col-md-6 col-sm-12"><?= $form->field($model, 'previous_school_name', ['inputTemplate' => '<div class="input-group"><span class="input-group-addon"><i class="fa fa-institution fa-one-point-five"></i></span></span>{input}</div>','inputOptions' => ['placeholder' => 'Name of School']])->label(false)->textInput(['maxlength' => true]) ?></div>
                                <div class="col-lg-3 col-md-3 col-sm-12"><?= $form->field($model, 'previous_school_phone', ['inputTemplate' => '<div class="input-group"><span class="input-group-addon"><i class="fa fa-phone fa-one-point-five"></i></span></span>{input}</div>','inputOptions' => ['placeholder' => 'Tel. No.']])->label(false)->textInput() ?></div>
                                <div class="col-lg-3 col-md-3 col-sm-12"><?= $form->field($model, 'previous_school_mobile', ['inputTemplate' => '<div class="input-group"><span class="input-group-addon"><i class="fa fa-mobile fa-one-point-five"></i></span></span>{input}</div>','inputOptions' => ['placeholder' => 'Mobile']])->label(false)->textInput() ?></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="container form-input-wrapper">
                                <div class="col-lg-5 col-md-5 col-sm-12"><?= $form->field($model, 'previous_school_description', ['inputTemplate' => '{input}','inputOptions' => ['placeholder' => 'Description']])->label(false)->textInput(['maxlength' => true]) ?></div>
                                <div class="col-lg-7 col-md-7 col-sm-12"><?= $form->field($model, 'previous_school_address', ['inputTemplate' => '<div class="input-group"><span class="input-group-addon"><i class="fa fa-road fa-one-point-five"></i></span></span>{input}</div>','inputOptions' => ['placeholder' => 'Address']])->label(false)->textInput(['maxlength' => true]) ?></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="container form-input-wrapper">                        
                                <div class="col-lg-4 col-md-4 col-sm-12"><?= $form->field($model, 'previous_school_teacher_in_charge', ['inputTemplate' => '<div class="input-group"><span class="input-group-addon"><i class="fa fa-user fa-one-point-five"></i></span></span>{input}</div>','inputOptions' => ['placeholder' => 'Teacher-in-charge']])->label(false)->textInput(['maxlength' => true]) ?></div>
                                <div class="col-lg-4 col-md-4 col-sm-12"><?= $form->field($model, 'previous_school_principal', ['inputTemplate' => '<div class="input-group"><span class="input-group-addon"><i class="fa fa-user fa-one-point-five"></i></span></span>{input}</div>','inputOptions' => ['placeholder' => 'Principal']])->label(false)->textInput(['maxlength' => true]) ?></div>
                            </div>
                        </div>
                    </div>

                    <div role="tabpanel" class="tab-pane" id="step5">
                        <div class="row">
                            <div class="container form-input-wrapper">
                                    <div class="col-lg-3 col-md-3 col-sm-12"><?= $form->field($model, 'student_photo', ['inputTemplate' => '<div class="input-group"><span class="input-group-addon"><span class="dropdown-list">Student\'s Photo</span></span></span>{input}</div>'])->dropDownList(['0' => 'Not Submitted', '1' => 'Submitted'])->label(false) ?></div>
                                    <div class="col-lg-3 col-md-3 col-sm-12"><?= $form->field($model, 'guardians_photo', ['inputTemplate' => '<div class="input-group"><span class="input-group-addon"><span class="dropdown-list">Guardians\' Photo</span></span></span>{input}</div>'])->dropDownList(['0' => 'Not Submitted', '1' => 'Submitted'])->label(false) ?></div>
                                    <div class="col-lg-3 col-md-3 col-sm-12"><?= $form->field($model, 'report_card', ['inputTemplate' => '<div class="input-group"><span class="input-group-addon"><span class="dropdown-list">Birth Certificate</span></span></span>{input}</div>'])->dropDownList(['0' => 'Not Submitted', '1' => 'Submitted'])->label(false) ?></div>
                                    <div class="col-lg-3 col-md-3 col-sm-12"><?= $form->field($model, 'birth_certificate', ['inputTemplate' => '<div class="input-group"><span class="input-group-addon"><span class="dropdown-list">Report Card</span></span></span>{input}</div>'])->dropDownList(['0' => 'Not Submitted', '1' => 'Submitted'])->label(false) ?></div>
                                    <div class="col-lg-3 col-md-3 col-sm-12"><?= $form->field($model, 'good_moral', ['inputTemplate' => '<div class="input-group"><span class="input-group-addon"><span class="dropdown-list"></span>Good Moral</span></span>{input}</div>'])->dropDownList(['0' => 'Not Submitted', '1' => 'Submitted'])->label(false) ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group pull-right">
                       <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                       <?= Html::a(Yii::t('app', 'Cancel'), ['/students'], ['class' => 'btn btn-default']) ?>
                    </div>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
    </div>
</div>
