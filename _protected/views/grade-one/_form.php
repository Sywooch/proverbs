<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\models\Card;
use app\models\Options;
use app\models\DataHelper;

/* @var $this yii\web\View */
/* @var $model app\models\GradeOneForm */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin(); ?>
<div class="ui three column stackable grid">
    <div class="four wide rounded column">

    </div>
    <div class="nine wide rounded column">
        <div class="column">
            <div class="ui segment">
                <?php switch ($grading) {
                    case 1:
                        echo '<h1 class="grading-period">First Grading</h1>';
                        break;
                    case 2:
                        echo '<h1 class="grading-period">Second Grading</h1>';
                        break;
                    case 3:
                        echo '<h1 class="grading-period">Third Grading</h1>';
                        break;

                    default:
                        echo '<h1 class="grading-period">Fourth Grading</h1>';
                        break;
                } ?>
                <br>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <?= $form->field($model, 'subject_1', ['inputTemplate' => '<label for="English">English</label>{input}', 'inputOptions' => ['class' => 'form-control pva-form-control'] ])->label(false) ?>
                        <?= $form->field($model, 'subject_2', ['inputTemplate' => '<label for="Math">Math</label>{input}', 'inputOptions' => ['class' => 'form-control pva-form-control'] ])->label(false) ?>
                        <?= $form->field($model, 'subject_3', ['inputTemplate' => '<label for="Science">Science</label>{input}', 'inputOptions' => ['class' => 'form-control pva-form-control'] ])->label(false) ?>
                        <?= $form->field($model, 'subject_4', ['inputTemplate' => '<label for="Civics">Civics</label>{input}', 'inputOptions' => ['class' => 'form-control pva-form-control'] ])->label(false) ?>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <?= $form->field($model, 'subject_5', ['inputTemplate' => '<label for="Christian Education">Christian Education</label>{input}', 'inputOptions' => ['class' => 'form-control pva-form-control'] ])->label(false) ?>
                        <?= $form->field($model, 'subject_6', ['inputTemplate' => '<label for="MTB">MTB</label>{input}', 'inputOptions' => ['class' => 'form-control pva-form-control'] ])->label(false) ?>
                        <?= $form->field($model, 'subject_7', ['inputTemplate' => '<label for="MAPEH">MAPEH</label>{input}', 'inputOptions' => ['class' => 'form-control pva-form-control'] ])->label(false) ?>
                        <?= $form->field($model, 'subject_8', ['inputTemplate' => '<label for="Filipino">Filipino</label>{input}', 'inputOptions' => ['class' => 'form-control pva-form-control'] ])->label(false) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <?= $form->field($model, 'core_value_1', ['inputTemplate' => '<label for="Makadiyos">Makadiyos</label>{input}', 'inputOptions' => ['class' => 'form-control pva-form-control'] ])->label(false) ?>
                        <?= $form->field($model, 'core_value_2', ['inputTemplate' => '<label for="Makatao">Makatao</label>{input}', 'inputOptions' => ['class' => 'form-control pva-form-control'] ])->label(false) ?>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <?= $form->field($model, 'core_value_3', ['inputTemplate' => '<label for="Makakalikasan">Makakalikasan</label>{input}', 'inputOptions' => ['class' => 'form-control pva-form-control'] ])->label(false) ?>
                        <?= $form->field($model, 'core_value_4', ['inputTemplate' => '<label for="Makabansa">Makabansa</label>{input}', 'inputOptions' => ['class' => 'form-control pva-form-control'] ])->label(false) ?>
                    </div>
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
                    <?= Html::submitButton($model->isNewRecord ? 'Add' : 'Save' , ['class' => 'ui link fluid huge primary submit button', 'style' => 'color: white;']) ?>
                    <br>
                    <?= Html::a(Yii::t('app', 'View'),['view', 'eid' => $eid, 'grading' => $grading], ['class' => 'ui link fluid huge teal button']) ?>
                    <br>
                    <?= Html::a(Yii::t('app', 'Cancel'),['/students'], ['class' => 'ui link fluid huge grey button']) ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>
<?php $this->render('switch'); ?>
<?php // $this->render('/layouts/_toast', ['model' => $model])?>
<?php
$this->registerJs("
    $('#grade-menu .ui.menu')
    .on('click', '.item', function() {
        $(this).addClass('active').siblings('.item').removeClass('active');
        var sel = $(this).attr('data-tab');
        var tab = $('.ui.tab.segment');
        var t = $('#grade-menu').find('[data-tab=\"' + sel + '\"]');
        $(t).addClass('active').removeClass('hidden').siblings('.ui.tab.segment').removeClass('active').addClass('hidden');
    });
");?>
