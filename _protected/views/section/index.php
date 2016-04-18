<?php

use yii\helpers\Html;
use app\models\UiListView;
use yii\widgets\Pjax;

$this->title = Yii::t('app', 'Users');
?>
<p></p>
<div class="ui two column stackable grid">
    <div class="twelve wide rounded column">
        <div class="panel panel-default rounded-edge">
            <div class="panel-body">
                <div class="pull-left"><h4>Sections</h4></div>
                <div class="pull-right"><?= Html::a('<i class="icon plus"></i>',['create'],['class' => 'ui large green icon button']) ?></div>
                <p></p>
                <br>
                <?= Html::a('','#',['id' => 'trig', 'class' => 'hidden']) ?>
                <?php Pjax::begin(['id' => 'section-list', 'timeout' => 10000, 'enablePushState' => false]); ?>
                    <?= UiListView::widget([
                           'dataProvider' => $dataProvider,
                            'itemView' => '_list',
                        ]); ?>
                <?php Pjax::end(); ?>
            </div>
        </div>
    </div>
    <div class="four wide rounded column">
        <?= $this->render('_search', ['model' => $searchModel]) ?>
    </div>
</div>