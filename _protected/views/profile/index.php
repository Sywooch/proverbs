<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ProfileFormSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title =  ucfirst($model->username);
//$this->params['breadcrumbs'][] = $this->title;
?>
<br>
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
                    <?= Html::a(Yii::t('app', 'Edit'),['update', 'id' => $model->id], ['class' => 'ui link fluid huge teal button']) ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->render('_self-pjax', ['model' => $model]) ?>
<?= $this->render('/layouts/_toast')?>
