<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\UiListView;
/* @var $this yii\web\View */
/* @var $searchModel app\models\SchoolYearSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'School Year';
?>
<p></p>
<div class="ui two column stackable grid">
    <div class="twelve wide rounded column">
        <div class="ui raised segment">
            <div class="ui black ribbon label" style="margin-left: -2px;">
                <h4>School Year</h4>
            </div>
            <div class="pull-right"><?= Html::a('<i class="icon plus"></i>',['create'],['class' => 'ui large green icon button']) ?></div>
            <p></p>
            <?= time() ?>
            <?php Pjax::begin(['id' => 'school-year-list', 'timeout' => 10000, 'enablePushState' => false]); ?>
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
<?= $this->render('/layouts/_toast')?>