<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\UiListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AssignedFormSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Assign Subject';
?>
<p></p>
<div class="ui two column stackable grid">
    <div class="twelve wide rounded column">
        <div class="ui raised segment">
            <div class="ui black ribbon label" style="margin-left: -2px;">
                <h4>Assigned Subject</h4>
            </div>
            <div class="pull-right"><?= Html::a('<i class="icon plus"></i>',['create'],['class' => 'ui large green icon button']) ?></div>
            <p></p>
            <?php Pjax::begin(['id' => 'assignsubject-list', 'timeout' => 60000]); ?>
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
<?= $this->render('/layouts/_toast')?>
<?php
$pjax = <<< JS
$(document).ready(function(){
    // setInterval(function(){
    //     $.pjax.reload({
    //         container:'#assignsubject-list',
    //         success: function(){
    //             $('ul.pagination > li.active > a').click()
    //         }
    //     });
    // }, 10000);
});
JS;
$this->registerJs($pjax);
?>
