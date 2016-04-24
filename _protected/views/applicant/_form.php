<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\jui\DatePicker;
use app\models\GradeLevel;
use app\models\Card;
use yii\helpers\ArrayHelper;

$grade_level = GradeLevel::find()->all();
$listData = ArrayHelper::map($grade_level, 'id' , 'name');
$avatar = Yii::$app->request->baseUrl . Yii::$app->params['avatar'];
!empty($model->students_profile_image) ? $img = Yii::$app->request->baseUrl . '/uploads/students/' . $model->students_profile_image : $img = $avatar;

$model->isNewRecord ? $this->title = 'New' : $this->title = implode(' ', [$model->first_name, !empty(trim($model->middle_name)) ? ucfirst(substr($model->middle_name, 0,1)).'.' : '', $model->last_name]);
?>
<p></p>
<?php $form = ActiveForm::begin(['class' => 'ui loading form']); ?>
<div class="ui two column stackable grid">
    <div class="four wide rounded column">
        <?= Card::render($options = [
            'imageContent' => $img,
            'labelContent' => !$model->isNewRecord ? implode(' ', ['ID#', '<strong>', $model->id, '</strong>']) : '&nbsp;',
            'labelFor' => 'Enrollee ID',
            'labelOptions' => '',
            'headerContent' => !$model->isNewRecord ? implode(' ', [$model->first_name, !empty(trim($model->middle_name)) ? $middle = ucfirst(substr($model->middle_name, 0,1)).'.' : $middle = '', $model->last_name]) : '&nbsp;',
            'headerOptions' => '',
            'metaContent' => !$model->isNewRecord ? implode('', ['\'', $model->nickname, '\'']) : '&nbsp',
            'metaOptions' => '',
            'leftFloatedContent' => !$model->isNewRecord ? $model->gradeLevel->name : '&nbsp;',
            'leftFloatedFor' => 'Grade Level',
            'leftFloatedOptions' => '',
            'rightFloatedContent' => '',
            'rightFloatedOptions' => !$model->isNewRecord ? $model->sped === 0 ? '' : 'hidden' : 'hidden'
        ]) ?>
    </div>
    <div class="nine wide rounded column">
        <div id="student-info-menu">
            <div class="ui five item pointing menu stackable">
                <a class="item active" data-tab="first">Student</a>
                <a class="item" data-tab="second">Parents</a>
                <a class="item" data-tab="third">Guardian</a>
                <a class="item" data-tab="fourth">Previous School</a>
                <a class="item" data-tab="fifth">Requirements</a>
            </div>
                <div class="ui tab segment active" data-tab="first">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <?php //PRINCIPALS VIEW
                                $form->field($model, 'status', ['inputTemplate' => '<div style="margin-top: -10px;"><label style="padding: 0; color: #555; font-weight: 600;">Active</label><div class="pull-right">{input}</div></div>'])->checkbox($options = ['class' => 'js-switch', 'data-switchery' => true, 'value' => $model->isNewRecord ? 1 : $model->status])->label(false) 
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-12"><?= $form->field($model, 'first_name', ['inputTemplate' => '<label>First</label>{input}', 'inputOptions' => ['class' => 'form-control pva-form-control'] ])->label(false) ?></div>
                        <div class="col-lg-4 col-md-4 col-sm-12"><?= $form->field($model, 'middle_name', ['inputTemplate' => '<label>Middle</label>{input}', 'inputOptions' => ['class' => 'form-control pva-form-control'] ])->label(false) ?></div>
                        <div class="col-lg-4 col-md-4 col-sm-12"><?= $form->field($model, 'last_name', ['inputTemplate' => '<label>Surname</label>{input}', 'inputOptions' => [] ])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-12"><?= $form->field($model, 'nickname', ['inputTemplate' => '<label>Nickname</label>{input}', 'inputOptions' => [] ])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?></div>
                        <div class="col-lg-4 col-md-4 col-sm-12"><?= $form->field($model, 'gender', ['inputTemplate' => '<label>Gender</label>{input}', 'inputOptions' => ['class' => 'form-control pva-form-control'] ])->dropDownList(['0' => 'Male', '1' => 'Female'])->label(false) ?></div>
                        <div class="col-lg-4 col-md-4 col-sm-12"><?= $form->field($model, 'birth_date', ['inputTemplate' => '<label>Birth Date</label>{input}'])->label(false)->widget(DatePicker::className(),['options' => ['class' => 'form-control pva-form-control']] ) ?></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-12"><?= $form->field($model, 'address', ['inputTemplate' => '<label>Address</label>{input}','inputOptions' => [] ])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?></div>
                        <div class="col-lg-4 col-md-4 col-sm-12"><?= $form->field($model, 'zip_code', ['inputTemplate' => '<label>Zip Code</label>{input}','inputOptions' => []])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-12"><?= $form->field($model, 'religion', ['inputTemplate' => '<label>Religion</label>{input}','inputOptions' => [] ])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?></div>
                        <div class="col-lg-4 col-md-4 col-sm-12"><?= $form->field($model, 'citizenship', ['inputTemplate' => '<label>Citizenship</label>{input}','inputOptions' => [] ])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-12"><?= $form->field($model, 'phone', ['inputTemplate' => '<label>Landline</label>{input}','inputOptions' => [] ])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?></div>
                        <div class="col-lg-4 col-md-4 col-sm-12"><?= $form->field($model, 'mobile', ['inputTemplate' => '<label>Mobile</label>{input}','inputOptions' => [] ])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?></div>
                    </div>
                </div>
                <div class="ui tab segment hidden" data-tab="second">
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-12"><?= $form->field($model, 'fathers_name', ['inputTemplate' => '<label>Father\'s Name</label>{input}','inputOptions' => [] ])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?></div>
                    </div>                    
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-12"><?= $form->field($model, 'fathers_phone', ['inputTemplate' => '<label>Landline</label>{input}','inputOptions' => [] ])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?></div>
                        <div class="col-lg-4 col-md-4 col-sm-12"><?= $form->field($model, 'fathers_mobile', ['inputTemplate' => '<label>Mobile</label>{input}','inputOptions' => [] ])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?></div>
                    </div>                    
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-12"><?= $form->field($model, 'fathers_email', ['inputTemplate' => '<label>Email</label>{input}','inputOptions' => [] ])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-12"><?= $form->field($model, 'fathers_religion', ['inputTemplate' => '<label>Religion</label>{input}','inputOptions' => [] ])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?></div>
                        <div class="col-lg-4 col-md-4 col-sm-12"><?= $form->field($model, 'fathers_citizenship', ['inputTemplate' => '<label>Citizenship</label>{input}','inputOptions' => [] ])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-12"><?= $form->field($model, 'fathers_occupation', ['inputTemplate' => '<label>Occupation</label>{input}','inputOptions' => [] ])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?></div>
                        <div class="col-lg-4 col-md-4 col-sm-12"><?= $form->field($model, 'fathers_employer', ['inputTemplate' => '<label>Employer</label>{input}','inputOptions' => [] ])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?></div>
                    </div>
                    <div class="row"><div class="col-lg-12"><div class="ui divider"></div></div></div>
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-12"><?= $form->field($model, 'mothers_name', ['inputTemplate' => '<label>Mother\'s Name</label>{input}','inputOptions' => [] ])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?></div>
                    </div>                    
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-12"><?= $form->field($model, 'mothers_phone', ['inputTemplate' => '<label>Landline</label>{input}','inputOptions' => [] ])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?></div>
                        <div class="col-lg-4 col-md-4 col-sm-12"><?= $form->field($model, 'mothers_mobile', ['inputTemplate' => '<label>Mobile</label>{input}','inputOptions' => [] ])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?></div>
                    </div>                    
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-12"><?= $form->field($model, 'mothers_email', ['inputTemplate' => '<label>Email</label>{input}','inputOptions' => [] ])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-12"><?= $form->field($model, 'mothers_religion', ['inputTemplate' => '<label>Religion</label>{input}','inputOptions' => [] ])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?></div>
                        <div class="col-lg-4 col-md-4 col-sm-12"><?= $form->field($model, 'mothers_citizenship', ['inputTemplate' => '<label>Citizenship</label>{input}','inputOptions' => [] ])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-12"><?= $form->field($model, 'mothers_occupation', ['inputTemplate' => '<label>Occupation</label>{input}','inputOptions' => [] ])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?></div>
                        <div class="col-lg-4 col-md-4 col-sm-12"><?= $form->field($model, 'mothers_employer', ['inputTemplate' => '<label>Employer</label>{input}','inputOptions' => [] ])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?></div>
                    </div>
                </div>
                <div class="ui tab segment hidden" data-tab="third">
                    <div class="ui two column">
                        <div class="six wide stackable column">
                            <div class="ui items">
                                <div class="item">
                                    <div class="ui small rounded image">
                                        <img src="<?= $avatar ?>" style="background: #e9eaed;">
                                    </div>
                                    <div class="content">
                                        <div class="row">
                                            <div class="col-lg-10 col-md-10 col-sm-12"><?= $form->field($model, 'guardians_name', ['inputTemplate' => '<label>Guardian\'s Name</label>{input}','inputOptions' => [] ])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-12"><?= $form->field($model, 'guardians_relation_to_student', ['inputTemplate' => '<label>Relation</label>{input}','inputOptions' => [] ])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12"><?= $form->field($model, 'guardians_address', ['inputTemplate' => '<label>Address</label>{input}','inputOptions' => [] ])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-12"><?= $form->field($model, 'guardians_phone', ['inputTemplate' => '<label>Landline</label>{input}','inputOptions' => [] ])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?></div>
                                            <div class="col-lg-6 col-md-6 col-sm-12"><?= $form->field($model, 'guardians_mobile', ['inputTemplate' => '<label>Mobile</label>{input}','inputOptions' => [] ])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-12"><?= $form->field($model, 'guardians_occupation', ['inputTemplate' => '<label>Occupation</label>{input}','inputOptions' => [] ])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?></div>
                                            <div class="col-lg-6 col-md-6 col-sm-12"><?= $form->field($model, 'guardians_employer', ['inputTemplate' => '<label>Employer</label>{input}','inputOptions' => [] ])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ui tab segment hidden" data-tab="fourth">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-12"><?= $form->field($model, 'previous_school_grade_level', ['inputTemplate' => '<label>Grade Level</label>{input}','inputOptions' => ['class' => 'form-control pva-form-control']])->dropDownList($listData, ['id', 'name'])->label(false) ?></div>
                        <div class="col-lg-4 col-md-4 col-sm-12"><?= $form->field($model, 'previous_school_from_school_year', ['inputTemplate' => '<label>From</label>{input}','inputOptions' => [] ])->label(false)->widget(DatePicker::className(),['options' => ['class' => 'form-control pva-form-control']] ) ?></div>
                        <div class="col-lg-4 col-md-4 col-sm-12"><?= $form->field($model, 'previous_school_to_school_year', ['inputTemplate' => '<label>To</label>{input}','inputOptions' => [] ])->label(false)->widget(DatePicker::className(),['options' => ['class' => 'form-control pva-form-control']] ) ?></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <?= $form->field($model, 'previous_school_teacher_in_charge', ['inputTemplate' => '<label>Teacher-in-charge</label>{input}','inputOptions' => [] ])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <?= $form->field($model, 'previous_school_principal', ['inputTemplate' => '<label>Principal</label>{input}','inputOptions' => [] ])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-12">
                            <?= $form->field($model, 'previous_school_average_grade', ['inputTemplate' => '<label>Average Grade</label>{input}','inputOptions' => [] ])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-12"><?= $form->field($model, 'previous_school_name', ['inputTemplate' => '<label>Name of School</label>{input}','inputOptions' => [] ])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-12"><?= $form->field($model, 'previous_school_address', ['inputTemplate' => '<label>Address</label>{input}','inputOptions' => [] ])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-12"><?= $form->field($model, 'previous_school_description', ['inputTemplate' => '<label>Description</label>{input}','inputOptions' => [] ])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-12"><?= $form->field($model, 'previous_school_phone', ['inputTemplate' => '<label>Landline</label>{input}','inputOptions' => [] ])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?></div>
                        <div class="col-lg-4 col-md-4 col-sm-12"><?= $form->field($model, 'previous_school_mobile', ['inputTemplate' => '<label>Mobile</label>{input}','inputOptions' => [] ])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?></div>
                    </div>
                </div>
                <div class="ui tab segment hidden" data-tab="fifth">
                    <div class="row">
                        <div class="col-lg-6">
                            <?= $form->field($model, 'student_photo', ['inputTemplate' => '<div style="margin-top: 0;"><label style="padding: 0; color: #555; font-weight: 600;">Student\'s Photo</label><div class="pull-right">{input}</div></div>'])->checkbox($options = ['class' => 'js-switch', 'data-switchery' => true, 'value' => $model->isNewRecord ? 1 : $model->student_photo])->label(false) ?>
                            <?= $form->field($model, 'guardians_photo', ['inputTemplate' => '<div style="margin-top: 0;"><label style="padding: 0; color: #555; font-weight: 600;">Guardian\'s Photo</label><div class="pull-right">{input}</div></div>'])->checkbox($options = ['class' => 'js-switch', 'data-switchery' => true, 'value' => $model->isNewRecord ? 1 : $model->guardians_photo])->label(false) ?>
                            <?= $form->field($model, 'report_card', ['inputTemplate' => '<div style="margin-top: 0;"><label style="padding: 0; color: #555; font-weight: 600;">Birth Certificate</label><div class="pull-right">{input}</div></div>'])->checkbox($options = ['class' => 'js-switch', 'data-switchery' => true, 'value' => $model->isNewRecord ? 1 : $model->report_card])->label(false) ?>
                            <?= $form->field($model, 'birth_certificate', ['inputTemplate' => '<div style="margin-top: 0;"><label style="padding: 0; color: #555; font-weight: 600;">Report Card</label><div class="pull-right">{input}</div></div>'])->checkbox($options = ['class' => 'js-switch', 'data-switchery' => true, 'value' => $model->isNewRecord ? 1 : $model->birth_certificate])->label(false) ?>
                            <?= $form->field($model, 'good_moral', ['inputTemplate' => '<div style="margin-top: 0;"><label style="padding: 0; color: #555; font-weight: 600;">Good Moral</label><div class="pull-right">{input}</div></div>'])->checkbox($options = ['class' => 'js-switch', 'data-switchery' => true, 'value' => $model->isNewRecord ? 1 : $model->good_moral])->label(false) ?>
                            <?= $form->field($model, 'student_has_sibling_enrolled', ['inputTemplate' => '<div style="margin-top: 0;"><label style="padding: 0; color: #555; font-weight: 600;">Siblings Enrolled</label><div class="pull-right">{input}</div></div>'])->checkbox($options = ['class' => 'js-switch', 'data-switchery' => true, 'value' => $model->isNewRecord ? 1 : $model->student_has_sibling_enrolled])->label(false) ?>
                        </div>
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
                    <?= Html::a(Yii::t('app', 'Cancel'),['/applicant'], ['class' => 'ui link fluid huge grey button']) ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>
<?php
$this->registerJs("
    $('#student-info-menu .ui.menu')
    .on('click', '.item', function() {
        $(this).addClass('active').siblings('.item').removeClass('active');
        var sel = $(this).attr('data-tab');
        var tab = $('.ui.tab.segment');
        var t = $('#student-info-menu').find('[data-tab=\"' + sel + '\"]');
        $(t).addClass('active').removeClass('hidden').siblings('.ui.tab.segment').removeClass('active').addClass('hidden');
    });
");?>
<?php $this->render('switch'); ?>