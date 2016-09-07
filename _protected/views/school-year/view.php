<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Options;
/* @var $this yii\web\View */
/* @var $model app\models\Section */

$this->title = $model->sy;
?>
<div class="ui two column stackable grid">
    <div class="thirteen wide column">
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
