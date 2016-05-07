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
           'options' => ['class' => 'ui fitted items', 'style' => 'padding: 0 5px 0 10px;', 'id' => 'bm'],
           'layout' => '{items}',
            'itemView' => '_board-list',
        ]); ?>
	<?php Pjax::end(); ?>
</div>