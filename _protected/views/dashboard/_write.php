<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $board app\models\Board */
/* @var $form yii\widgets\ActiveForm */
$this->registerJs(
   '$("document").ready(function(){ 
        $("#new_country").on("pjax:end", function() {
            $.pjax.reload({container:"#pjax-board"});  //Reload GridView
        });
    });'
);
?>
<?php Pjax::begin(['id' => 'pjax-write']) ?>
	<?php $form = ActiveForm::begin(['options' => ['data-pjax' => true ]]); ?>
		<div id="write-form-textarea">
			<?= $form->field($board, 'content', ['inputTemplate' => '<div class="input-group write-group">{input}<span class="input-group-addon addon-submit-btn"><button type="submit" id="write-submit-btn" class="btn btn-block btn-write"><i class="fa fa-send-o fa-one-point-five"></i></button></span></div>', 'inputOptions' => []])->textarea(['maxlength' => true,'id' => 'write-textarea'])->label(false) ?>
		</div>
	<?php ActiveForm::end(); ?>
<?php Pjax::end(); ?>