<?php

use yii\web\View;
use yii\widgets\DetailView;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use app\models\Tuition;
use app\models\GradeLevel;

	if(!empty($array)) {
		$grade_level 	= GradeLevel::findOne($array[0]['grade_level_id'])['name'];
		$enrollment 	= number_format($array[0]['enrollment'], 2);
		$admission 		= number_format($array[0]['admission'], 2);
		$tuition_fee 	= number_format($array[0]['tuition_fee'], 2);
		$misc_fee 		= number_format($array[0]['misc_fee'], 2);
		$ancillary 		= number_format($array[0]['ancillary'], 2);
		$monthly 		= number_format($array[0]['monthly'], 2);
		$yearly 		= number_format($array[0]['yearly'], 2);
		$books 			= number_format($array[0]['books'], 2);
	} else {
		$grade_level 	= 0;
		$enrollment 	= 0;
		$admission 		= 0;
		$tuition_fee 	= 0;
		$misc_fee 		= 0;
		$ancillary 		= 0;
		$monthly 		= 0;
		$yearly 		= 0;
		$books 			= 0;
	}

?>
<div class="assessment-form-form">
	<div class="row">
	    <?php $form = ActiveForm::begin(); ?>
	    <?= $form->field($model, 'tuition_id', ['inputTemplate' => '{input}', 'inputOptions' => ['class' => 'hidden']])->textInput()->label(false) ?>
		<div class="col-lg-4 col-md-4 col-sm-12">
		<table class="table table-striped table-bordered detail-view">
			<tbody>
				<th>Grade Level</th><td><span class="pull-right"><?= $grade_level ?></span></td></tr>
				<tr><th>Enrollment</th><td><span class="pull-right"><?= $enrollment ?></span></td></tr>
				<tr><th>Admission</th><td><span class="pull-right"><?= $admission ?></span></td></tr>
				<tr><th>Tuition</th><td><span class="pull-right"><?= $tuition_fee ?></span></td></tr>
				<tr><th>Miscellaneous</th><td><span class="pull-right"><?= $misc_fee ?></span></td></tr>
				<tr><th>Ancillary</th><td><span class="pull-right"><?= $ancillary ?></span></td></tr>
				<tr><th>Yearly</th><td><span class="pull-right"><?= $yearly ?></span></td></tr>
				<tr><th>Monthly</th><td><span class="pull-right"><?= $monthly ?></span></td></tr>
				<tr><th>Books</th><td><span class="pull-right"><?= $books ?></span></td></tr>
			</tbody>
		</table>
		<p></p>
		    <div class="form-group">
		        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		    </div>
		</div>
	    <?php ActiveForm::end(); ?>
	</div>
</div>
