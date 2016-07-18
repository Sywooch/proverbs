<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Options;
/* @var $this yii\web\View */
/* @var $model app\models\GradeOneForm */

?>
<br>
<div class="ui three column stackable grid">
    <div class="four wide column">
        <div class="column">
            <?= $this->render('_card', ['models' => $models]) ?>
        </div>
    </div>
    <div class="nine wide column">
        <div class="column">
            <?= $this->render('_detail', ['models' => $models]) ?>
        </div>
    </div>
    <div class="three wide column">
        <div class="column">
            <div class="ui fluid vertical menu">
                <div class="ui fluid huge label item">
                    <span>Options</span>
                </div>
                <div class="item">
                    <?= Html::a(Yii::t('app', 'Edit'),['update', 'eid' => $eid], ['class' => 'ui link fluid huge teal button']) ?>
                    <br>
                    <?= Html::a(Yii::t('app', 'Cancel'),['/grade-one'], ['class' => 'ui link fluid huge grey button']) ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->render('/layouts/_toast', ['models' => $models])?>
