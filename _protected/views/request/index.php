<?php

use yii\helpers\Html;
use app\models\UiListView;
use yii\widgets\Pjax;

$this->title = 'Data Requests';
?>
<div class="data-request-index">
    <p></p>
    <div class="ui two column stackable grid">
        <div class="twelve wide rounded column">
            <div class="ui raised segment">
                <div class="ui black ribbon label" style="margin-left: -2px;">
                    <h4>Requests</h4>
                </div>
                <div class="pull-right"><?= Html::a('<i class="icon plus"></i>',['create'],['class' => 'ui large green icon button']) ?></div>
                <p></p>
                <?php Pjax::begin(['id' => 'student-list', 'timeout' => 60000]); ?>
                    <?= UiListView::widget([
                       'dataProvider' => $dataProvider,
                        'itemView' => '_list',
                    ]); ?>
                <?php Pjax::end(); ?>
            </div>
        </div>
        <div class="four wide column">
            <?= $this->render('_search', ['model' => $searchModel]) ?>
        </div>
    </div>
</div>
