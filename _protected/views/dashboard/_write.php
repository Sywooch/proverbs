<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\Pjax;
?>

<?php Pjax::begin(['id' => 'pjax-write']) ?>
	<?php $form = ActiveForm::begin(['options' => ['data-pjax' => true ]]); ?>
		<div id="write-form-textarea">
			<?= $form->field($board, 'content', ['inputTemplate' => '{input}<button type="submit" id="write-submit-btn" class="btn btn-block btn-write">send</button>'])->textarea(['maxlength' => true,'id' => 'write-textarea'])->label(false) ?>
		</div>
	<?php ActiveForm::end(); ?>
<?php Pjax::end(); ?>