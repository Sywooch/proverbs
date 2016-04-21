<?php

use yii\helpers\Html;
use app\models\UiListView;
use yii\widgets\Pjax;

$this->title = Yii::t('app', 'Section');
?>
<p></p>
<div class="ui two column stackable grid">
    <div class="twelve wide rounded column">
        <div class="ui raised segment">
            <div class="ui black ribbon label" style="margin-left: -2px;">
                <h4>Sections</h4>
            </div>
            <div class="pull-right"><?= Html::a('<i class="icon plus"></i>',['create'],['class' => 'ui large green icon button']) ?></div>
            <p></p>
            <?php Pjax::begin(['id' => 'section-list', 'timeout' => 10000, 'enablePushState' => false]); ?>
                <?= UiListView::widget([
                       'dataProvider' => $dataProvider,
                        'itemView' => '_list',
                    ]); ?>
            <?php Pjax::end(); ?>
        </div>
    </div>
    <div class="four wide rounded column">
        <?= $this->render('_search', ['model' => $searchModel]) ?>
    </div>
</div>