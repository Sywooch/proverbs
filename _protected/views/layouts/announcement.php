<?php
use yii\helpers\Html;
use app\models\UiListView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use app\rbac\models\AuthAssignment;
use app\models\DataCenter;
?>
<div class="modal fade" id="ann_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" clientOptions="backdrop: false;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="color: white;"><i class="icon-close" style="font-size: 10px;"></i></span></button>
            <h4 class="modal-title" id="myModalLabel"><i class="icon-flag"></i>&nbsp;&nbsp;Announcements</h4>
        </div>
        <div id="announcement-modal" class="modal-body" style="padding: 0 0 10px 10px;">
            <?php Pjax::begin(['id' => 'anc-list-modal', 'timeout' => 360000]) ?>
                <?= UiListView::widget([
                       'dataProvider' => DataCenter::recentAnnouncement(Yii::$app->session->get('announcementSize')),
                       'options' => ['class' => 'ui divided relaxed items', 'style' => 'padding-top: 10px;'],
                       'layout' => '{items}',
                        'itemView' => '_announcement-list-modal',
                    ])
                ?>
            <?php Pjax::end() ?>
            <div style="text-align: center; margin-bottom: -15px; margin-top: 10px;"><button id="view-more-announcement" class="ui fluid basic small circular icon button">View More</button></div>
            <br>
        </div>
        <div class="modal-footer">
            <?php if(AuthAssignment::getAssignment(Yii::$app->user->identity->id) === 'dev' || AuthAssignment::getAssignment(Yii::$app->user->identity->id) === 'master' || AuthAssignment::getAssignment(Yii::$app->user->identity->id) === 'admin'):  ?>
            <div class="ui fluid container">
                <?= Html::textarea('', null, ['id' => 'ann-form', 'type' => 'textarea', 'style' => 'height: 60px; margin-bottom: 10px;', 'class' => 'form-control pva-form-control', 'maxlength' => 255, 'rows' => 4]) ?>
                <div class="ui right floated">
                    <button id="anc-send" type="button" method="post" class="ui big positive button" style="margin-right: 0;">Add</button>
                </div>
            </div>
            <?php endif ?>
        </div>
    </div>
  </div>
</div>