<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model app\models\ImageUploadForm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="image-upload-form-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

	<?php // $form->field($model, 'file')->widget(Widget::className(), ['uploadUrl' => Url::toRoute('/user/user/uploadPhoto'),]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
