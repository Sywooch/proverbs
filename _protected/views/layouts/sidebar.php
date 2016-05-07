<?php
use yii\helpers\Html;
use app\rbac\models\AuthAssignment;
use app\models\DataCenter;
?>
<div class="sidebar smooth">
    <div id="sidebar-offset"></div>
    <div id="announcement">
        <?= $this->render('announcement')?>
    </div>
    <div id="sidebar-content">
        <?= $this->render('board') ?>
    </div>
    <div id="sidebar-write">
        <?= $this->render('write') ?>
    </div>
</div>
<?php
if(!Yii::$app->user->isGuest){
    $host = json_encode(Yii::$app->request->baseUrl . '/site/sbar?data=');
    
    if(empty(Yii::$app->session['sidebar'])){
    	$sbar = json_encode(1);
    }else {
    	$sbar = json_encode(0);
}

$board_pjax = <<< JS
    var sidebar = $('#sb-btn1');
    var sbar;
	
    if(parseInt($sbar) === 0){
		setSbar(0);
    } else {
		setSbar(1);
    }

	//console.log('load: ' + sbar);

    function getSbar(){
        return sbar;
    }

    function setSbar(data){
        sbar = data;
    }

    function run(){
    	console.log('running...');
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
JS;
$this->registerJs($board_pjax);
}
?>

<?php
$baseUrl = json_encode(Yii::$app->request->baseUrl . '/site/announcement?data=');
$upd = json_encode(DataCenter::countAnnouncement());
$pjaxInt = json_encode(Yii::$app->params['announcementInterval']);
$anc_pjax = <<< JS
$(document).ready(function(){
    var val;
    var ini = true;

    function pjax(){
        $.pjax.reload({container:'#announcement-list'});
    }

    function getIni(data){
        return ini;
    }

    function setIni(data){
        ini = data;
    }

    function getUpd(){
        if(ini){
            return $upd;
        }else {
            return val;
        }
    }

    setInterval(function(){
        $.ajax({
            type: 'POST',
            url: $baseUrl + JSON.stringify({
                    upd: getUpd(),
                }),
            contentType: 'application/json; charset=utf-8',
            dataType: 'json',
            success: function(data) {
                if(data.pjax){
                    pjax();
                    if(data.delta){
                        val = data.upd;
                        setIni(false);
                    }
                }
            }
        });
    }, $pjaxInt);
});
JS;
$this->registerJs($anc_pjax);
?>