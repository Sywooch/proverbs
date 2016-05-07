<?php 
use app\models\DataCenter;
use app\models\UiListView;
use yii\widgets\Pjax;
$dataProvider = DataCenter::board();
?>
<div id="board-content" style="padding: 10px;">
	<?php Pjax::begin(['id' => 'board-list', 'timeout' => 60000]); ?>
        <?= UiListView::widget([
           'dataProvider' => $dataProvider,
           'options' => ['class' => 'ui fitted items', 'style' => 'margin-right: -10px;', 'id' => 'bm'],
           'layout' => '{items}',
            'itemView' => '_board-list',
        ]); ?>
	<?php Pjax::end(); ?>
</div>