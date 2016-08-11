<?php
use yii\helpers\Html;
use app\models\UiListView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use app\rbac\models\AuthAssignment;
use app\models\DataCenter;
?>
<?php if(AuthAssignment::getAssignment(Yii::$app->user->identity->id) === 'dev' || AuthAssignment::getAssignment(Yii::$app->user->identity->id) === 'master' || AuthAssignment::getAssignment(Yii::$app->user->identity->id) === 'admin'|| AuthAssignment::getAssignment(Yii::$app->user->identity->id) === 'principal'):  ?>
    <div id="announcement-wrap" class="menu" style="height: 475px;">
<?php else: ?>
    <div id="announcement-wrap" class="menu" style="height: 360px;">
<?php endif ?>
    <div id="announcement-ctr">
        <?php Pjax::begin(['id' => 'anc-list-modal', 'timeout' => 360000]) ?>
            <?= UiListView::widget([
                   'dataProvider' => DataCenter::recentAnnouncement(Yii::$app->session->get('announcementSize')),
                   'options' => ['class' => 'ui divided relaxed items', 'style' => 'padding-top: 10px;'],
                   'layout' => '{items}',
                    'itemView' => '_announcement-list',
                ])
            ?>
        <?php Pjax::end() ?>
        <div style="text-align: center; margin-bottom: -15px; margin-top: 10px; padding-bottom: 15px;">
            <button id="view-more-announcement" class="ui fluid basic small circular icon button">View More</button>
        </div>
        <br>
    </div>
    <?php if(AuthAssignment::getAssignment(Yii::$app->user->identity->id) === 'dev' || AuthAssignment::getAssignment(Yii::$app->user->identity->id) === 'master' || AuthAssignment::getAssignment(Yii::$app->user->identity->id) === 'admin' || AuthAssignment::getAssignment(Yii::$app->user->identity->id) === 'principal'):  ?>
    <div class="announcement-write">
        <div class="ui fluid container">
            <?= Html::textarea('', null, ['id' => 'ann-form', 'type' => 'textarea', 'style' => 'height: 60px; margin-bottom: 10px;', 'class' => 'form-control pva-form-control', 'maxlength' => 255, 'rows' => 4]) ?>
            <div class="ui right floated">
                <button id="anc-send" type="button" method="post" class="ui big positive button" style="margin-right: 0;">Add</button>
            </div>
        </div>
    </div>
<?php endif ?>
</div>
