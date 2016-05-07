<?php 
use yii\helpers\Html;
use yii\widgets\Pjax;
use app\models\UiListView;
use app\models\DataCenter;
$announcement = DataCenter::announcement();
?>
<?php Pjax::begin(['id' => 'announcement-list', 'timeout' => 60000]); ?>
    <?= UiListView::widget([
       'dataProvider' => $announcement,
       'options' => ['class' => 'ui divided relaxed items', 'style' => 'padding: 10px;'],
       'layout' => '{items}',
        'itemView' => '_announcement-list',
    ]); ?>
<?php Pjax::end() ?>