<?php
use yii\helpers\Html;
use app\rbac\models\AuthAssignment;
use app\models\DataCenter;
?>
<aside class="sidebar smooth">
    <div id="sidebar-offset">
        <div id="sb-btn1" class="sidebar-toggle-menu">
            <a id="trigger-sidebar">
                <i class="chevron right icon"></i>
            </a>
        </div>
    </div>
    <div id="sidebar-content">
        <?= $this->render('board') ?>
    </div>
    <div id="sidebar-write">
        <?= Html::textarea('', null, ['id' => 'send', 'type' => 'textarea', 'placeholder' => 'Write something...', 'class' => 'form-control pva-form-control', 'maxlength' => 255, 'rows' => 3]) ?>
    </div>
</aside>
<?php
if(!Yii::$app->user->isGuest){
    $host = json_encode(Yii::$app->request->baseUrl . '/site/sbar?data=');

    if(empty(Yii::$app->session['sidebar'])){
    	$sbar = json_encode(1);
    }else {
    	$sbar = json_encode(0);
}

$sidebar = <<< JS
    (function($){
        $(window).load(function(){
            var sidebar = $('#sb-btn1');
            var sbar;

            if(parseInt($sbar) === 0){
                setSbar(0);
            } else {
                setSbar(1);
            }

            function getSbar(){
                return sbar;
            }

            function setSbar(data){
                sbar = data;
            }

            function run(){
                //console.log('running...');
                $.ajax({
                    type: 'POST',
                    url: $host + JSON.stringify({
                            val: getSbar(),
                        }),
                    contentType: 'application/json; charset=utf-8',
                    dataType: 'json',
                    success: function(data){
                        //console.log('val: ' + data['val']);
                    }
                });
            }

            sidebar.click(function(){
                if(parseInt(getSbar()) === 1){
                    setSbar(0);
                }else {
                    setSbar(1);
                }
                //console.log('exec run: ' + getSbar());
                run();
            });
        });
    })(jQuery);
JS;
$this->registerJs($sidebar);
}
?>
