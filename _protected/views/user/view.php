<?php
use yii\helpers\Html;
$avatar = Yii::$app->params['avatar'];
$this->title = ucfirst($model->username);
?>
<p></p>
<div class="ui two column stackable grid">
    <div class="four wide column">
        <div class="column">
            <?= $this->render('_card', ['model' => $model]) ?> 
        </div>
    </div>
    <div class="nine wide column">
        <div class="column">
            <?= $this->render('_detail', ['model' => $model]) ?>
        </div>
    </div>
    <div class="three wide column">
        <div class="column">
            <div class="ui fluid vertical menu">
                <div class="ui fluid huge label item">
                    <span>Options</span>
                </div>
                <div class="item">
                    <?= Html::a(Yii::t('app', 'New'),['create'], ['class' => 'ui link fluid huge primary button']) ?>
                    <p></p>
                    <?= Html::a(Yii::t('app', 'Edit'),['update', 'id' => $model->id], ['class' => 'ui link fluid huge teal button']) ?>
                    <p></p>
                    <?= Html::button('Delete', ['id' => 'delete','type'=>'button', 'class' => 'ui link fluid huge grey button']) ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->render('_pjax', ['model' => $model]) ?>
<?= $this->render('_modal') ?>
<?php
$modal = <<< JS
$(document).ready(function(){
    var btn = $('#delete');
    btn.click(function(){
        $('.ui.basic.modal').modal('show');
    });
});

JS;
$this->registerJs($modal);
?>
