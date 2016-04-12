<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use yii\bootstrap\ActiveForm;
use app\models\GradeLevel;
use app\models\Section;

$grade_level = GradeLevel::find()->all();
$section = Section::find()->all();
$listData = ArrayHelper::map($grade_level, 'id' , 'name');
$listData2 = ArrayHelper::map($section, 'id' , 'section_name');
?>
<p></p>
<?php $form = ActiveForm::begin(); ?>
<div class="section-form">
    <div class="row">
            <div class="col-lg-9 col-md-9 col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="container form-input-wrapper">
                            <div class="col-lg-9 col-md-9 col-sm-12">

                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <?= $form->field($model, 'grade_level_id', ['inputTemplate' => '<div class="input-div-wrap"><label>Grade Level</label></label>{input}</div>', 'inputOptions' => ['class' => 'form-control pva-form-control']])->dropDownList($listData, ['id', 'name'])->label(false) ?>
                                <?= $form->field($model, 'section_name', ['inputTemplate' => '<div class="input-div-wrap"><label>Section Name</label></label>{input}</div>','inputOptions' => ['class' => 'form-control pva-form-control']])->label(false)->textInput(['maxlength' => true]) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success btn-block' : 'btn btn-primary']) ?>
                        <?= Html::a(Yii::t('app', 'Cancel'), ['/section'], ['class' => 'btn btn-default btn-block']) ?>
                    </div>
                </div>
            </div>
    </div>
</div>
<?php ActiveForm::end(); ?>