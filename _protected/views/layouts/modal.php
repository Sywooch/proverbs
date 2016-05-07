<?php
use yii\helpers\Html;
use app\models\UiListView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
?>
<div class="modal fade" id="ann_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" clientOptions="backdrop: false;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header" style="background: #FCFCFC; border-bottom: 1px solid #e9e9e9;">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="color: #555;"><i class="icon-close" style="font-size: 10px;"></i></span></button>
                <h4 class="modal-title" id="myModalLabel" style="color: #555;"><i class="icon-flag"></i>&nbsp;&nbsp;Announcements</h4>
        </div>
        <div id="announcement-modal" class="modal-body">
            <div id="modal-target" class="ui fluid container"></div>
        </div>
        <div class="modal-footer">
            <div class="ui fluid container">
                <?= Html::textarea('', null, ['id' => 'ann-form', 'type' => 'textarea', 'style' => 'height: 60px;', 'class' => 'form-control pva-form-control', 'maxlength' => 255, 'rows' => 4]) ?>
                <br>
                <div class="ui right floated">
                    <button id="anc-send" type="button" method="post" class="ui big positive button">Add</button>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>
<?php
$annInt = json_encode(Yii::$app->params['announcementInterval']);
$push_url = json_encode(Yii::$app->request->baseUrl . '/site/new-announcement?data=');
$write = <<< JS
$(window).load(function(){
    var tf = $('#ann-form');
    var anc_send = $('#anc-send');

    anc_send.click(function(){
        write();
        clr();
    });

    function pjax(){
        $.pjax.reload({container:'#anc-list-modal'});
    }

    function clr(){
        setTimeout(function(){
            tf.val('');
            pjax();
        }, 2);
    }

    function write(){
        $.ajax({
            type: 'POST',
            url: $push_url + JSON.stringify({
                    msg: tf.val(),
                }),
            contentType: 'application/json; charset=utf-8',
            dataType: 'json',
            success: clr(),
        });
    }
});
JS;
$this->registerJs($write);
?>