<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use app\models\ApplicantForm;
?>

<div class="entrance-exam-form-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="container form-input-wrapper">
            <div class="col-lg-4 col-md-4 col-sm-12">
                <?= $form->field($model, 'applicant_id')->widget(Select2::classname(), [
                        'data' => ArrayHelper::map(ApplicantForm::find()->where(['status' => 2])->all(), 'id', function($model){return $model->id . ' ' . $model->last_name . ', ' . $model->first_name . ' ' . $model->middle_name;}),
                        'language' => 'en',
                        'options' => ['id' => 'auto-suggest','placeholder' => 'Applicant ID #'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ])->label(false); 
                ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="container form-input-wrapper">
            <div class="col-lg-3 col-md-3 col-sm-12"><?= $form->field($model, 'english', ['inputTemplate' => '<div class="input-group"><span class="input-group-addon"><span class="custom-input-group-addon">English</span></span></span>{input}</div>'])->label(false)->textInput() ?></div>
            <div class="col-lg-3 col-md-3 col-sm-12"><?= $form->field($model, 'reading_skills', ['inputTemplate' => '<div class="input-group"><span class="input-group-addon"><span class="custom-input-group-addon">Reading Skills</span></span></span>{input}</div>'])->label(false)->textInput() ?></div>
            <div class="col-lg-3 col-md-3 col-sm-12"><?= $form->field($model, 'science', ['inputTemplate' => '<div class="input-group"><span class="input-group-addon"><span class="custom-input-group-addon">Science</span></span></span>{input}</div>'])->label(false)->textInput() ?></div>
            <div class="col-lg-3 col-md-3 col-sm-12"><?= $form->field($model, 'comprehension', ['inputTemplate' => '<div class="input-group"><span class="input-group-addon"><span class="custom-input-group-addon">Comprehension</span></span></span>{input}</div>'])->label(false)->textInput() ?></div>
        </div>
    </div>
    <div class="row">
        <div class="container form-input-wrapper">
            <div class="col-lg-3 col-md-3 col-sm-12"><?= $form->field($model, 'remarks', ['inputTemplate' => '{input}', 'inputOptions' => ['placeholder' => 'Remarks']])->label(false)->textInput(['maxlength' => true]) ?></div>
            <div class="col-lg-3 col-md-3 col-sm-12"><?= $form->field($model, 'recommendations', ['inputTemplate' => '{input}', 'inputOptions' => ['placeholder' => 'Recommendations']])->label(false)->textInput(['maxlength' => true]) ?></div>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Cancel'), ['/entrance-exam'], ['class' => 'btn btn-default']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
