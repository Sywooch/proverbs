<?php

use app\models\Card;
use app\models\DataHelper;
use app\models\GradeLevel;
use app\models\Options;
use app\models\SchoolYear;
use app\models\Section;
use app\models\User;
use app\rbac\models\AuthItem;
use kartik\select2\Select2;
use nesbot\Carbon;
use yii\bootstrap\ActiveForm;
use yii\jui\DatePicker;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

$teachers = User::find()->joinWith('role')->where(['item_name' => 'teacher'])->orderBy(['last_name' => SORT_ASC])->all();

if($model->isNewRecord){
    $this->title = 'New';
}else {
    $this->title = $model->id;
}

?>
<p></p>
<?php $form = ActiveForm::begin(['class' => 'ui loading form']); ?>
<div class="ui three column stackable grid">
    <div class="four wide rounded column">
        <?= Card::render($options = [
            'imageContent' => !$model->isNewRecord ? !empty($model->teacher->profile_image) ? ['/file', 'id' => $model->teacher->profile_image] : Yii::$app->params['avatar'] : Yii::$app->request->baseUrl . Yii::$app->params['avatar'],
            'labelContent' => !$model->isNewRecord ? implode(' ', ['ID#', '<strong>', $model->teacher->id, '</strong>']) : '&nbsp;',
            'labelFor' => 'Applicant ID',
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
                        ])->label(false) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <?= $form->field($model, 'grade_level_id', ['inputTemplate' => '<label style="padding: 0; color: #555; font-weight: 600;">Grade Level</label>{input}', 'inputOptions' => ['class' => 'form-control pva-form-control'] ])
                        ->dropDownList(ArrayHelper::map(GradeLevel::find()->all(), 'id' , 'name'), [
                        'onchange' => "
                            $.post('". Yii::$app->urlManager->createUrl('enroll/section?id=') . "'+parseInt($('#classadviserform-grade_level_id').val()), function(data){
                                $('#classadviserform-section_id').find('option').remove();
                                $('#classadviserform-section_id').each(function(){
                                    $(this).append(data);
                                });
                            });
                        ",
                    ['class' => 'form-control pva-form-control'] ])
                    ->label(false) ?>
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
<?php
$this->registerJs("
    $('.datepicker').datepicker();
");
?>
