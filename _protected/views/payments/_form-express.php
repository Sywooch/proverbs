<?php 
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use app\models\Card;
use app\models\DataHelper;


?>
<?php $form = ActiveForm::begin(['class' => 'ui loading form']); ?>
<div class="ui three column stackable grid">
    <div class="four wide rounded column">
        <?= Card::render($options = [
            'imageContent' => !empty($student->students_profile_image) ? ['/file', 'id' => $student->students_profile_image] : Yii::$app->params['avatar'],
            'labelContent' => implode(' ', ['ID#', '<strong>', $student->id, '</strong>']),
            'labelFor' => 'Student ID',
            'labelOptions' => '',
            'headerContent' => DataHelper::name($student->first_name, $student->middle_name, $student->last_name),
            'headerOptions' => '',
            'metaContent' => implode('', ['\'', $student->nickname, '\'']),
            'metaOptions' => '',
            'leftFloatedContent' => DataHelper::gradeLevel($student->grade_level_id),
            'leftFloatedFor' => 'Grade Level',
            'leftFloatedOptions' => '',
            'rightFloatedContent' => '',
            'rightFloatedOptions' => $student->sped === 0 ? '' : 'hidden'
        ]) ?>
    </div>
    <div class="nine wide rounded column">
        <div class="ui rounded segment">
            <div class="ui two column stackable grid">
                <div class="eight wide column"><?= $form->field($model, 'transaction', ['inputTemplate' => '<div style="margin-top: 0;"><label style="padding: 0; color: #555; font-weight: 600;">Card</label><div class="pull-right">{input}</div></div>'])->checkbox($options = ['class' => 'js-switch', 'data-switchery' => true, 'value' => $model->isNewRecord ? 1 : $model->transaction])->label(false) ?></div>
            </div>
            <div class="ui two column stackable grid">
                <div class="four wide column">
                    <label for="Total Assessed">Total Assessed</label><p></p>
                </div>
                <div class="four wide right aligned column">
                    <span class="ui right aligned"><strong>&#8369; <?= number_format($assessment->total_assessed, 2, '.', '') ?></strong></span>
                </div>
            </div>
            <div class="ui two column stackable grid">
                <div class="four wide column">
                    <label for="Current Balance">Current Balance</label><p></p>
                </div>
                <div class="four wide right aligned column">
                    <span class="ui right aligned"><strong>&#8369; <?= number_format($assessment->balance, 2, '.', '') ?></strong></span>
                </div>
            </div>
            <div class="ui divider"></div>
            <div class="ui two right aligned stackable grid">
                <div class="eight wide column"><label for="Current Balance">Current Balance</label></div>
                <div class="eight wide column"><strong><?= number_format($assessment->balance, 2, '.', '') ?></strong></div>
            </div>
            <div class="ui two right aligned stackable grid">
                <div class="eight wide column">Payment</div>
                <div class="eight wide column">
                    <?= $form->field($model, 'paid_amount', ['inputTemplate' => '{input}','inputOptions' => [] ])->label(false)->textInput(['id' => 'pa', 'class' => 'form-control pva-form-control', 'style' => 'text-align: right;', 'placeholder' => '0.00'], ['maxlength' => true]) ?>
                    <div class="ui divider"></div>
                </div>
            </div>
            <div class="ui two right aligned stackable grid">
                <div class="eight wide column"><label for="New Balance"><strong>New Balance</strong></label></div>
                <div class="eight wide column"><strong><span id="new-balance"><?= number_format($assessment->balance, 2, '.', '') ?></span></strong></div>
            </div>
            <?php
                $bal = json_encode($assessment->balance);
                $this->registerJs("
                    $(document).ready(function(){
                        var nb = $('#new-balance');
                        var pa = $('#pa');
                        var pr = $(pa).parent()[0];

                        pa.blur(function(){
                            if(!$(pr).hasClass('has-error')){
                                nb.text( (parseFloat($bal) - parseFloat(pa.val()) ).toFixed(2) );
                            }
                        });
                    });
                ");
            ?>
        </div>
    </div>
    <div class="three wide rounded column">
        <div class="column">
            <div class="ui fluid vertical menu">
                <div class="ui fluid huge label item">
                    <span>Options</span>
                </div>
                <div class="item">
                    <p></p>
                    <?= Html::submitButton($model->isNewRecord ? 'Add' : 'Save' , ['class' => 'ui link fluid huge primary submit button', 'style' => 'color: white;']) ?>                    
                    <p></p>
                    <?= Html::a(Yii::t('app', 'Cancel'),['/payments'], ['class' => 'ui link fluid huge grey button']) ?>
            </div>
        </div>
    </div>
</div>
<?= $this->render('/layouts/switch') ?>
<?php ActiveForm::end(); ?>