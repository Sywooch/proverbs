<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EnrolledFormSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="enrolled-form-search">
    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
    <a class="btn btn-warning btn-block" role="button" data-toggle="collapse" href="#enroll-profile-more" aria-expanded="false" aria-controls="enroll-profile-more" aria-expanded="false" aria-controls="enroll-profile-more">More Search Filters</a>
    <p></p>
    <?= $form->field($model, 'student_id', ['inputTemplate' => '<label><strong>Student</strong></label>{input}', 'inputOptions' => ['class' => 'form-control']])->label(false) ?>
    <div class="collapse" id="enroll-profile-more">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <?= $form->field($model, 'grade_level_id', ['inputTemplate' => '<div class="input-div-wrap"><label>Grade Level</label>{input}</div>','inputOptions' => ['class' => 'form-control pva-form-control']])->dropDownList($model->levelList)->label(false) ?>
                <?= $form->field($model, 'enrollment_status', ['inputTemplate' => '<div class="input-div-wrap"><label>Enrollment Status</label>{input}</div>','inputOptions' => ['class' => 'form-control pva-form-control']])->dropDownList($model->statusList)->label(false) ?>    
                <?= $form->field($model, 'sy_id', ['inputTemplate' => '<div class="input-div-wrap"><label>School Year</label>{input}</div>','inputOptions' => ['class' => 'form-control pva-form-control']])->dropDownList($model->syList)->label(false) ?>                
            </div>
        </div>
    </div>
    <p></p>
    <div class="form-group">
        <?= Html::submitButton('Search', ['id' => 'searchBtn', 'class' => 'btn btn-primary btn-block']) ?>
        <?= Html::resetButton('Reset', ['id' => 'resetBtn','class' => 'btn btn-default btn-block']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<?php
$this->render('switch');
$this->registerJs("
    
");
?>