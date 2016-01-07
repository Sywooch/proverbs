<?php
use yii\helpers\Html;
use kartik\select2\Select2;
use app\models\ApplicantForm;
use app\models\ActiveRecord;
use app\models\StudentForm;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
?>

<div class="payment-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="container form-input-wrapper">
            <div class="col-lg-4 col-md-4 col-sm-12">
                <?= $form->field($model, 'student_id')->widget(Select2::classname(), [
                        'data' => ArrayHelper::map(StudentForm::find()->all(),'id', function($model){return $model->id . ' ' . $model->last_name . ', ' . $model->first_name . ' ' . $model->middle_name;}),
                        'language' => 'en',
                        'options' => ['id' => 'auto-suggest','placeholder' => 'Enter ID #'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ])->label(false); 
                ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="container form-input-wrapper">
            <div class="col-lg-3 col-md-3 col-sm-12"><?= $form->field($model, 'paid_amount',  ['inputTemplate' => '{input}', 'inputOptions' => ['placeholder' => 'Amount']])->label(false)->textInput() ?></div>
            <div class="col-lg-3 col-md-3 col-sm-12"><?= $form->field($model, 'type', ['inputTemplate' => '<div class="input-group"><span class="input-group-addon"><span class="dropdown-list">Transaction</span></span></span>{input}</div>'])->dropDownList(['0' => 'Cash', '1' => 'Card'], ['default' => 'Cash'])->label(false) ?></div>
            <div class="col-lg-3 col-md-3 col-sm-12"><?= $form->field($model, 'payment_date',  ['inputTemplate' => '{input}', 'inputOptions' => ['placeholder' => 'Date of Payment']])->label(false)->textInput() ?></div>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Cancel'), ['/payments'], ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
