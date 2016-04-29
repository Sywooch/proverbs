<?php
use yii\helpers\Html;
use app\rbac\models\AuthAssignment;
if (!Yii::$app->user->isGuest) {$role = AuthAssignment::getAssignment(Yii::$app->user->identity->id);} ?>
<div class="sidebar smooth">
	<div class="sidebar-content">
	    <ul class="navigation">
	        <?= $this->render('menu') ?>
    	</ul>
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

$trigger = <<< JS
    var sidebar = $('.sidebar-toggle-menu');
    var sidebar2 = $('.navbar-toggle.offcanvas');
	var sbar;
	
    if(parseInt($sbar) === 0){
		setSbar(0);
    } else {
		setSbar(1);
    }

	console.log('load: ' + sbar);

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

    sidebar2.click(function(){
        if(parseInt(getSbar()) === 1){
			setSbar(0);
        }else {
			setSbar(1);
        }
        //console.log('exec run: ' + getSbar());
        run();
    });
JS;
$this->registerJs($trigger);
}
?>