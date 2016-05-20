<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\models\GradeLevel;
use yii\helpers\ArrayHelper;

$grade_level = GradeLevel::find()->all();
$listData = ArrayHelper::map($grade_level, 'id' , 'name');
?>

<p></p>
<?php $form = ActiveForm::begin(); ?>
<div class="ui three column stackable grid">
    <div class="twelve wide rounded column">
    <div class="panel panel-default rounded-edge">
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12"><?= $form->field($model, 'section_name', ['inputTemplate' => '<label>Section Name</label>{input}','inputOptions' => [] ])->label(false)->textInput(['class' => 'form-control pva-form-control'], ['maxlength' => true]) ?></div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12"><?= $form->field($model, 'grade_level_id', ['inputTemplate' => '<label style="padding: 0; color: #555; font-weight: 600;">Grade Level</label>{input}', 'inputOptions' => ['class' => 'form-control pva-form-control'] ])->dropDownList($listData,['class' => 'form-control pva-form-control'])->label(false)?></div>
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
                    <?= Html::a(Yii::t('app', 'Cancel'),['/section'], ['class' => 'ui link fluid huge grey button']) ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>