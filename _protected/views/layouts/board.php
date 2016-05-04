<?php 
use app\models\DataCenter;
use app\models\UiListView;
use yii\widgets\Pjax;
$dataProvider = DataCenter::board();
?>
<div id="board-content">
	<?php Pjax::begin(['id' => 'board-list', 'timeout' => 60000]); ?>
        <?= UiListView::widget([
           'dataProvider' => $dataProvider,
           'options' => ['class' => 'ui divided relaxed items', 'style' => 'padding: 10px;', 'id' => 'bm'],
           'layout' => '{items}',
            'itemView' => '_list',
        ]); ?>
	<?php Pjax::end(); ?>
</div>