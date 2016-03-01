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

<div class="section-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="container form-input-wrapper">
            <div class="col-lg-3 col-md-3 col-sm-12">
				<?= $form->field($model, 'grade_level_id', ['inputTemplate' => '<div class="input-group"><span class="input-group-addon"><span class="dropdown-list">Grade Level</span></span></span>{input}</div>'])->dropDownList($listData, ['id', 'name'])->label(false) ?>
			</div>
		</div>
	</div>
    <div class="row">
        <div class="container form-input-wrapper">
            <div class="col-lg-3 col-md-3 col-sm-12">
    			<?= $form->field($model, 'section_name', ['inputTemplate' => '<div class="input-group"><span class="input-group-addon"><span>Section Name</span></span></span>{input}</div>','inputOptions' => ['placeholder' => '']])->label(false)->textInput(['class' => 'form-control'], ['maxlength' => true]) ?>
			</div>
		</div>
	</div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
