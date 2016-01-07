<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model app\models\Message */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="message-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'recepient')->widget(Select2::classname(), [
		    'data' => ArrayHelper::map(app\models\User::find()->all(), 'id', 'username'),
		    'language' => 'en',
		    'options' => ['id' => 'auto-suggest','placeholder' => 'Enter Username'],
		    'pluginOptions' => [
		        'allowClear' => true
		    ],
		]); ?>

    <?= $form->field($model, 'content')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Send' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
