<?php
use yii\helpers\Html;
use app\rbac\models\AuthAssignment;
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
                    <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                        'class' => 'ui link fluid huge grey button',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ],
                    ]) ?>
                    <?php // Html::a('Delete',['delete', 'id' => $model->id], ['title'=>'Delete Record', 'class' => 'ui link fluid huge grey button', 'data' => ['confirm' => Yii::t('app', 'Are you sure you want to delete this record?'),'method' => 'post']]) ?>
                    <p></p>
                    <?php // Html::button('Click', ['id' => 'del', 'class' => 'ui link fluid huge orange button']) ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
$flash = Yii::$app->session->getAllFlashes();
foreach ($flash as $error) {
    var_dump($error);
}
 ?>
<?= $this->render('_pjax', ['model' => $model]) ?>
<?php
$uid = json_encode(Yii::$app->user->identity->id);
$this->registerJs("
$(document).ready(function(){
    var del = $('#del');

    del.click(function(){
        $.ajax({
            type: 'POST',
            url: 'permission',
            contentType: 'application/json; charset=utf-8',
            dataType: 'json',
            success: function(data) {
                console.log(data);
            }
        });
    });
});
");
?>