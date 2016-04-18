<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>

<p></p>
<?php $form = ActiveForm::begin(); ?>
<div class="ui three column stackable grid">
    <div class="four wide rounded column">
        <div class="ui center aligned stackable cards">
            <div class="card">
                <div class="image"><img src="<?= Yii::$app->request->baseUrl . '/uploads/ui/section-bg.jpg' ?>" alt="bg" class="tiny image"></div>
            </div>
        </div>
    </div>
    <div class="nine wide rounded column">
    <div class="panel panel-default rounded-edge">
        <div class="panel-body">
            
        </div>
    </div>
    </div>
    <div class="three wide rounded column">
        <div class="column">
            <?= Html::submitButton($model->isNewRecord ? '<i class="left floated icon plus" style="color: white;"></i>New' : 'Save' , ['class' => 'ui link fluid huge primary submit button', 'style' => 'color: white;']) ?>
            <p></p>
            <?= Html::a(Yii::t('app', 'Cancel'),['/section'], ['class' => 'ui link fluid huge basic button']) ?>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>