<?php
use app\models\Options;
use yii\helpers\Html;
$this->title = $model->username;
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
            <?= Options::render(['scenario' => Yii::$app->controller->action->id, 'id' => $model->id]); ?>
        </div>
    </div>
</div>
<?= $this->render('_pjax', ['model' => $model]) ?>
<?= $this->render('/layouts/_toast')?>
