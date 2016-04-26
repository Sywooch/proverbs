<?php 
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Card;
use app\models\DataHelper;
use app\models\Options;


$avatar = Yii::$app->request->baseUrl . Yii::$app->params['avatar'];
!$model->isNewRecord ? !empty($model->enrolled->student->students_profile_image) ? $img = Yii::$app->request->baseUrl . '/uploads/students/' . $model->enrolled->student->students_profile_image : $img = $avatar : '';
!$model->isNewRecord ? !empty(trim($model->enrolled->student->middle_name)) ? $middle = ucfirst(substr($model->enrolled->student->middle_name, 0,1)).'.' : $middle = '' : '';
!$model->isNewRecord ? $this->title = implode(' ', [$model->enrolled->student->first_name, $middle, $model->enrolled->student->last_name]) : 'New';
?>
<p></p>
<?php $form = ActiveForm::begin(); ?>
<div class="ui three column stackable grid">
    <div class="four wide rounded column">
        <?= Card::render($options = [
            'imageContent' => !$model->isNewRecord ? $img : $avatar,
            'labelContent' => !$model->isNewRecord ? implode(' ', ['ID#', '<strong>', $model->enrolled->student->id, '</strong>']) : '&nbsp;',
            'labelFor' => 'Applicant ID',
            'labelOptions' => '',
            'headerContent' => !$model->isNewRecord ? DataHelper::name($model->enrolled->student->first_name, $model->enrolled->student->middle_name, $model->enrolled->student->last_name) : '&nbsp;',
            'headerOptions' => '',
            'metaContent' => !$model->isNewRecord ? implode('', ['\'', $model->enrolled->student->nickname, '\'']) : '&nbsp',
            'metaOptions' => '',
            'leftFloatedContent' => !$model->isNewRecord ? DataHelper::gradeLevel($model->enrolled->student->grade_level_id) : '&nbsp;',
            'leftFloatedFor' => '',
            'leftFloatedOptions' => '',
            'rightFloatedContent' => '',
            'rightFloatedOptions' => !$model->isNewRecord ? $model->enrolled->student->sped === 0 ? '' : 'hidden' : 'hidden'
        ]) ?>
    </div>
    <div class="nine wide rounded column">
        <div class="ui segment">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <?= $form->field($model, 'has_sibling_discount', ['inputTemplate' => '<div style="margin-top: 0;"><label style="padding: 0; color: #555; font-weight: 600;">Sibling Discount</label><div class="pull-right">{input}</div></div>'])->checkbox($options = ['class' => 'js-switch', 'data-switchery' => true, 'value' => $model->isNewRecord ? 1 : $model->has_sibling_discount])->label(false) ?>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-12"></div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <?= $form->field($model, 'percentage_value', ['inputTemplate' => '<label style="padding: 0; color: #555; font-weight: 600;">Percentage Value</label>{input}', 'inputOptions' => ['class' => 'form-control pva-form-control'] ])->dropDownList(DataHelper::siblingDiscount(),['class' => 'form-control pva-form-control'])->label(false)?>
                        </div>
                    </div>
                    <div class="ui form">
                        <?php if($model->isNewRecord):?>
                            <div id="f1" class="field">
                        <?php else : ?>
                            <?php if($model->has_sibling_discount === 0):?>
                                <div id="f1" class="field">
                            <?php else : ?>
                                <div id="f1" class="disabled field">
                            <?php endif?>
                        <?php endif?>
                            <?= $form->field($model, 'sibling_discount', ['inputTemplate' => '<label for="Discount">&nbsp;</label>{input}','inputOptions' => [] ])->label(false)->textInput(['style' => 'text-align: right;' , 'class' => 'form-control pva-form-control'], ['maxlength' => true]) ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <?= $form->field($model, 'has_honor_discount', ['inputTemplate' => '<div style="margin-top: 0;"><label style="padding: 0; color: #555; font-weight: 600;">Honor Discount</label><div class="pull-right">{input}</div></div>'])->checkbox($options = ['class' => 'js-switch', 'data-switchery' => true, 'value' => $model->isNewRecord ? 1 : $model->has_honor_discount])->label(false) ?>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-12"></div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="ui form">
                        <?php if($model->isNewRecord):?>
                            <div id="f2" class="field">
                        <?php else : ?>
                            <?php if($model->has_honor_discount === 0):?>
                                <div id="f2" class="field">
                            <?php else : ?>
                                <div id="f2" class="disabled field">
                            <?php endif?>
                        <?php endif?>
                            <?= $form->field($model, 'honor_discount', ['inputTemplate' => '<label for="Discount">&nbsp;</label>{input}','inputOptions' => [] ])->label(false)->textInput(['style' => 'text-align: right;' , 'class' => 'form-control pva-form-control'], ['maxlength' => true]) ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <?= $form->field($model, 'has_book_discount', ['inputTemplate' => '<div style="margin-top: 0;"><label style="padding: 0; color: #555; font-weight: 600;">Book Discount</label><div class="pull-right">{input}</div></div>'])->checkbox($options = ['class' => 'js-switch', 'data-switchery' => true, 'value' => $model->isNewRecord ? 1 : $model->has_book_discount])->label(false) ?>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-12"></div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="ui form">
                        <?php if($model->isNewRecord):?>
                            <div id="f3" class="field">
                        <?php else : ?>
                            <?php if($model->has_book_discount === 0):?>
                                <div id="f3" class="field">
                            <?php else : ?>
                                <div id="f3" class="disabled field">
                            <?php endif?>
                        <?php endif?>
                            <?= $form->field($model, 'book_discount', ['inputTemplate' => '<label for="Discount">&nbsp;</label>{input}','inputOptions' => [] ])->label(false)->textInput(['style' => 'text-align: right;' , 'class' => 'form-control pva-form-control'], ['maxlength' => true]) ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="sixteen wide grid">
                <div class="ui clearing divider"></div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12"></div>
                <div class="col-lg-4 col-md-4 col-sm-12"></div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <?= $form->field($model, 'total_assessed', ['inputTemplate' => '<label>Total Assessed</label>{input}','inputOptions' => [] ])->label(false)->textInput(['style' => 'text-align: right;' , 'class' => 'form-control pva-form-control'], ['maxlength' => true]) ?>
                </div>
            </div>
            <div class="sixteen wide grid">
                <div class="ui clearing divider"></div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12"></div>
                <div class="col-lg-4 col-md-4 col-sm-12"></div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <?= $form->field($model, 'balance', ['inputTemplate' => '<label>Balance</label>{input}','inputOptions' => [] ])->label(false)->textInput(['style' => 'text-align: right;' , 'class' => 'form-control pva-form-control'], ['maxlength' => true]) ?>
                </div>
            </div>
        </div>
    </div>
    <div class="three wide rounded column">
        <div class="column">
            <?= Options::render(['scenario' => Yii::$app->controller->action->id,'id' => $model->id]); ?>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>
<?= $this->render('/layouts/_toast', ['model' => $model])?>
<?= $this->render('/layouts/switch'); ?>
<?= $this->render('js-events', ['model' => $model]); ?>