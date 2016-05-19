<?php 
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Card;
use app\models\DataHelper;
use app\models\Options;


$avatar = Yii::$app->params['avatar'];
!$model->isNewRecord ? !empty($model->enrolled->student->students_profile_image) ? $img = Yii::$app->request->baseUrl . '/uploads/students/' . $model->enrolled->student->students_profile_image : $img = $avatar : '';
!$model->isNewRecord ? !empty(trim($model->enrolled->student->middle_name)) ? $middle = ucfirst(substr($model->enrolled->student->middle_name, 0,1)).'.' : $middle = '' : '';
!$model->isNewRecord ? $this->title = implode(' ', [$model->enrolled->student->first_name, $middle, $model->enrolled->student->last_name]) : 'New';

$has_sibling = json_encode($model->enrolled->student->student_has_sibling_enrolled); 
$enrollment = json_encode($model->tuition->enrollment);
$admission = json_encode($model->tuition->admission);
$tuition_fee = json_encode($model->tuition->tuition_fee);
$misc_fee = json_encode($model->tuition->misc_fee);
$ancillary = json_encode($model->tuition->ancillary);
$yearly = json_encode($model->tuition->yearly);
$monthly = json_encode($model->tuition->monthly);
$books = json_encode($model->tuition->books);
$subtotal = json_encode(number_format($enrollment + $admission + $misc_fee + $ancillary + $tuition_fee, 2, '.', ''));

if($model->isNewRecord){
    //$sbd = json_encode();
    //$hnd = json_encode();
    //$bkd = json_encode();
}else {
    $sbd = json_encode($model->sibling_discount);
    $hnd = json_encode($model->honor_discount);
    $bkd = json_encode($model->book_discount);
}

?>
<p></p>
<?php $form = ActiveForm::begin(); ?>
<div class="ui three column stackable grid">
    <div class="four wide rounded column">
        <?= Card::render($options = [
            'imageContent' => !$model->isNewRecord ? 
                !empty($model->enrolled->student->students_profile_image) ? ['/file', 'id' => $model->enrolled->student->students_profile_image] : implode('',[Yii::$app->request->baseUrl, Yii::$app->params['avatar']])
                        : implode('',[Yii::$app->request->baseUrl, Yii::$app->params['avatar']]),
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
            <?= !$model->isNewRecord ? Html::tag('label',implode('', [implode('-', array_map('ucfirst', explode('-', Yii::$app->controller->id))),'# ', $model->id]), ['class' => 'ui fluid big label']) : '' ?>
            <br>
            <br>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <?= $form->field($model, 'has_sibling_discount', ['inputTemplate' => '<div style="margin-top: 0;"><label style="padding: 0; color: #555; font-weight: 600;">Sibling Discount</label><div class="pull-right">{input}</div></div>'])->checkbox($options = ['class' => 'js-switch', 'data-switchery' => true, 'value' => $model->isNewRecord ? 1 : $model->has_sibling_discount])->label(false) ?>
                    <?= $form->field($model, 'percentage_value', ['inputTemplate' => '<label style="padding: 0; color: #555; font-weight: 600;">Percentage Value</label>{input}', 'inputOptions' => ['class' => 'form-control pva-form-control'] ])->dropDownList(DataHelper::siblingDiscount(),['class' => 'form-control pva-form-control'])->label(false)?>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-12"></div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div style="text-align: right;">
                                <p></p>
                                <p><?= $tuition_fee ?></p>
                                <small>x</small> <span id="pv">0</span>%
                            </div>
                            <div class="ui clearing divider" style="padding: 2px; margin: 2px;"></div>
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
                            <?= $form->field($model, 'sibling_discount', ['inputTemplate' => '{input}','inputOptions' => [] ])->label(false)->textInput(['style' => 'text-align: right; font-size: 12px;' , 'class' => 'form-control pva-form-control'], ['maxlength' => true]) ?>
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
                            <?= $form->field($model, 'honor_discount', ['inputTemplate' => '<label for="Discount">&nbsp;</label>{input}','inputOptions' => [] ])->label(false)->textInput(['style' => 'text-align: right; font-size: 12px;' , 'class' => 'form-control pva-form-control'], ['maxlength' => true]) ?>
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
                            <?= $form->field($model, 'book_discount', ['inputTemplate' => '<label for="Discount">&nbsp;</label>{input}','inputOptions' => [] ])->label(false)->textInput(['style' => 'text-align: right; font-size: 12px;' , 'class' => 'form-control pva-form-control'], ['maxlength' => true]) ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="sixteen wide grid">
                <div class="ui clearing divider"></div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <table id="tuition-table" class="ui very basic fixed table">
                        <tr>
                            <td><label for="Enrollment">Enrollment</label></td>
                            <td><?= number_format($enrollment,2, '.', '') ?></td>
                        </tr>
                        <tr>
                            <td><label for="Admission">Admission</label></td>
                            <td><?= number_format($admission,2, '.', '') ?></td>
                        </tr>
                        <tr>
                            <td><label for="Miscellaneous">Miscellaneous</label></td>
                            <td><?= number_format($misc_fee,2, '.', '') ?></td>
                        </tr>
                        <tr>
                            <td><label for="Ancillary">Ancillary</label></td>
                            <td><?= number_format($ancillary,2, '.', '') ?></td>
                        </tr>
                        <tr>
                            <td><label for="Tuition">Tuition</label></td>
                            <td><?= number_format($tuition_fee,2, '.', '') ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><strong><?= number_format($yearly, 2, '.', '') ?></strong></td>
                        </tr>
                        <tr>
                            <td style="border-top: 0;"><label for="Books">Books</label></td>
                            <td style="border-top: 0;">+ <?= number_format($books,2, '.', '') ?></td>
                        </tr>
                        <tr>
                            <td><label for="Sub Total"><strong>Sub Total</strong></label></td>
                            <td>&#8369; <strong><?= number_format(($yearly + $books), 2, '.', '') ?></strong></td>
                        </tr>
                    </table>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-12"></div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <table class="ui very basic fixed table">
                        <tbody>
                            <tr>
                                <td><label for="Sub Total">Sub Total</label></td>
                                <td style="text-align: right;"><strong><?= ($yearly + $books) ?></strong></td>
                            </tr>
                            <tr>
                                <td style="border-top: 0;"><strong>-</strong></td>
                                <td id="td-sibling-discount" style="text-align: right; border-top: 0;"><strong><?= $model->isNewRecord ? number_format(0, 2, '.', '') : number_format($model->sibling_discount, 2, '.', '')  ?></strong></td>
                            </tr>
                            <tr>
                                <td style="border-top: 0;"><strong>-</strong></td>
                                <td id="td-honor-discount" style="text-align: right; border-top: 0;"><strong><?= $model->isNewRecord ? number_format(0, 2, '.', '') : number_format($model->honor_discount, 2, '.', '')  ?></strong></td>
                            </tr>
                            <tr>
                                <td style="border-top: 0;"><strong>-</strong></td>
                                <td id="td-book-discount" style="text-align: right; border-top: 0;"><strong><?= $model->isNewRecord ? number_format(0, 2, '.', '') : number_format($model->book_discount, 2, '.', '')  ?></strong></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td id="td-total-assessed" style="text-align: right;"><strong><?= number_format(( ($yearly + $books) - $model->sibling_discount - $model->honor_discount - $model->book_discount ), 2, '.', '') ?></strong></td>
                            </tr>
                        </tbody>
                    </table>
                    <?= $form->field($model, 'total_assessed', ['inputTemplate' => '<label><strong>Total Assessed</strong></label>{input}','inputOptions' => [] ])->label(false)->textInput(['style' => 'text-align: right;' , 'class' => 'form-control pva-form-control'], ['maxlength' => true]) ?>
                    <p></p>
                    <button id="calc" class="ui fluid huge orange button hidden" type="button" style="font-size: 12px; margin-bottom: 5px;">Calculate</button>
                </div>
            </div>
            <div class="ui segments">
                <div class="ui center aligned segment">
                    <div class="row">
                        <div class="col-lg-4 col-mg-4 col-sm-12"></div>
                        <div class="col-lg-4 col-mg-4 col-sm-12">
                            <?= !$model->isNewRecord ? implode(' ', ['<label><strong>Balance</strong></label>','Php', number_format($model->balance, 2)]) : $form->field($model, 'balance', ['inputTemplate' => '<label for="BALANCE"><strong>BALANCE</strong></label>{input}','inputOptions' => [] ])->label(false)->textInput(['style' => 'text-align: right; font-size: 12px;' , 'class' => 'form-control pva-form-control'], ['maxlength' => true]) ?>
                        </div>
                        <div class="col-lg-4 col-mg-4 col-sm-12"></div>
                    </div>
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
<?= $this->render('js-events', [
    'model' => $model,
    'has_sibling' => $has_sibling,
    'enrollment' => $enrollment,
    'admission' => $admission,
    'tuition_fee' => $tuition_fee,
    'misc_fee' => $misc_fee,
    'ancillary' => $ancillary,
    'yearly' => $yearly,
    'monthly' => $monthly,
    'books' => $books,
    'sbd' => $sbd,
    'hnd' => $hnd,
    'bkd' => $bkd,
    'subtotal' => $subtotal,
]); ?>