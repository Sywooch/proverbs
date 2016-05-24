<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\models\GradeLevel;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\SchoolYear */
/* @var $form yii\widgets\ActiveForm */
?>
<p></p>
<?php $form = ActiveForm::begin(); ?>
<div class="ui three column stackable grid">
    <div class="thirteen wide rounded column">
    <div class="panel panel-default rounded-edge">
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12"><?= $form->field($model, 'sy', ['inputTemplate' => '<label>School Year</label>{input}','inputOptions' => [] ])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?></div>
            </div>
        </div>
    </div>
    </div>
    <div class="three wide rounded column">
        <div class="column">
            <div class="ui fluid vertical menu">
                <div class="ui fluid huge label item">
                    <span>Options</span>
                </div>
                <div class="item">
                    <?= Html::submitButton($model->isNewRecord ? 'Add' : 'Save' , ['class' => 'ui link fluid huge primary submit button']) ?>
                    <p></p>
                    <?php if(!$model->isNewRecord): ?>
                    <?= Html::a(Yii::t('app', 'View'),['view', 'id' => $model->id], ['class' => 'ui link fluid huge teal button']) ?>
                    <p></p>
                    <?php endif ?>
                    <?= Html::a(Yii::t('app', 'Cancel'),['/school-year'], ['class' => 'ui link fluid huge grey button']) ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>
