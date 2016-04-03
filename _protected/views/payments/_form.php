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
<?php
if($model->isNewRecord){
$sw = <<< JS
$(document).ready(function(){
    $('input[type=checkbox]').filter('.js-switch').filter(
            'input:not([data-switchery=true])').each(function() {
        var switches = new Switchery(this, options);
    });

    var hash = '#';
    var blank = '';

    function syncValue(object){
        if(object.value !== object.previousElementSibling){
            object.previousElementSibling.value = object.value;
        }
    }

    $('input.js-sw').each(function(){
        var elem = $(this).attr('class').split(' ').pop();
        var temp = '.' + $(this).attr('class').split(' ').pop();
        
        var elem = document.querySelector(temp);
        
        syncValue(elem);

        elem.onchange = function() { 
            if(elem.checked){
                $(hash + elem.id).val(0);
                $(hash + elem.id).prev().val(0);
            } else {
                $(hash + elem.id).val(1);
                $(hash + elem.id).prev().val(1);
            }
        };
    });
});
JS;
$this->registerJs($sw);
} else {
$swu = <<< JS
$(document).ready(function(){
    var switches_update = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

    switches_update.forEach(function(html) {
      var switches_update = new Switchery(html);
    });

    var hash = '#';
    var blank = '';

    function syncValue(object){
        if(object.value !== object.previousElementSibling){
            object.previousElementSibling.value = object.value;
        }
    }

    function changeState(object){
        if(parseInt(object.value) === 1) {
            if (typeof $(hash + object.id).attr('checked') !== typeof undefined && $(hash + object.id).attr('checked') !== false) {
                $(hash + object.id).removeAttr('checked').removeAttr('data-switchery');
                object.checked = false;
                $(object.nextElementSibling).click().click();
            }
        } else {
            $(hash + object.id).attr('checked', true);
            $(hash + object.id).attr('data-switchery', true);
            object.checked = true;
            $(object.nextElementSibling).click().click();
        }
    }

    $('input.js-sw').each(function(){
        var elem = $(this).attr('class').split(' ').pop();
        var temp = '.' + $(this).attr('class').split(' ').pop();
        var elem = document.querySelector(temp);
        
        syncValue(elem);
        changeState(elem);

        elem.onchange = function() { 
            if(elem.checked){
                $(hash + elem.id).val(0);
                $(hash + elem.id).prev().val(0);
            } else {
                $(hash + elem.id).val(1);
                $(hash + elem.id).prev().val(1);
            }
        };
    });
});
JS;
$this->registerJs($swu);
}
?>