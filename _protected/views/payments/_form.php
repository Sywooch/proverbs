<?php
use yii\helpers\Html;
use kartik\select2\Select2;
use app\models\ApplicantForm;
use app\models\ActiveRecord;
use app\models\StudentForm;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use app\assets\AppAsset;
?>

<div class="payment-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="container form-input-wrapper">
            <?= $form->field($model, 'transaction', ['inputTemplate' => '<label style="color: #555; padding-right: 15px;">Card</label>{input}'])
                ->checkbox($options = ['class' => 'js-switch', 
                'value' => $model->isNewRecord ? 1 : $model->transaction,
                'data-switchery' => true,
                ])->label(false) 
            ?>
         </div>
     </div>
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
            <div class="col-lg-3 col-md-3 col-sm-12"><?= $form->field($model, 'paid_amount',  ['inputTemplate' => '<label style="color: #555; padding-right: 15px;">Amount</label>{input}', 'inputOptions' => ['placeholder' => '0']])->textInput(['class' => 'form-control text-align-right'])->label(false) ?></div>               
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Cancel'), ['/payments'], ['class' => 'btn btn-default']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>