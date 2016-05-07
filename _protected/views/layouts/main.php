<?php
use app\assets\AppAsset;
use app\widgets\Alert;
use app\models\DataCenter;
use yii\bootstrap\ButtonDropdown;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use yii\widgets\ListView;
use yii\widgets\Pjax;
use yii\web\View;
AppAsset::register($this);
?>
<?php if(!Yii::$app->user->isGuest){$role = app\rbac\models\AuthAssignment::getAssignment(Yii::$app->user->identity->id);}?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta name="description" content=""/>
    <meta name="Elevate Solutions Inc." content="Proverbsville Academy Enrollment System" />
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link rel="icon" type="image/png" sizes="192x192"  href="<?= Yii::$app->request->baseUrl . '/themes/proverbs/' ?>images/favicon-96x96.png?>">
    <!-- <link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,300' rel='stylesheet' type='text/css'>
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&amp;subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script> -->
    <!-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script> -->
    <!-- <script src='https://www.google.com/recaptcha/api.js'></script> -->
    <?php $this->head() ?>
</head>
<body <?= Yii::$app->request->url === '/proverbs/site/login' || Yii::$app->request->url === '/proverbs/site/signup' || Yii::$app->request->url === '/proverbs/login' || Yii::$app->request->url === '/proverbs/signup' ? 'style="display:table;"' : '';?> class="<?= Yii::$app->session->get('sidebar') ?>">
    <?php $this->beginBody() ?>
        <?php if(Yii::$app->request->url === '/proverbs/site/login' || Yii::$app->request->url === '/proverbs/login'){include('alert.php');}?>
        </div>
    <?php
        if(Yii::$app->user->isGuest){
            echo $content;
        } elseif($role === 'parent') {
            include('header.php');
            include('alert.php');
            echo $content;
        } else { //MAIN
            include('header.php');
            include('sidebar.php');
            echo '<div id="st" class="page-content smooth"><p></p>';
            include('alert.php');
            echo $content;
            echo '</div>';
            include('modal.php');
            include('script.php');
        }
    ?>
    <?php 
    $this->registerJs("
        $('.ui.left.vertical.menu.sidebar').sidebar('setting', 'transition', 'push').sidebar('attach events', '#trigger-sidebar, #sb-btn2', 'toggle');
    ");
     ?>
    <?php $this->endBody() ?>
    <?php 
        $this->registerJs("
            (function($){
                $(window).load(function(){
                    $('#announcement-modal.modal-body').mCustomScrollbar({
                        autoHideScrollbar: true,
                        contentTouchScroll: 25,
                        documentTouchScroll: true,
                        scrollInertia : 500,
                        scrollButtons:{
                            scrollbarPosition: 'outside',
                            enable:true,
                            theme: 'dark',
                        },
                        theme: 'dark-thick',
                    });
                    $('#announcement').mCustomScrollbar({
                        autoHideScrollbar: true,
                        contentTouchScroll: 25,
                        documentTouchScroll: true,
                        scrollInertia : 500,
                        scrollButtons:{
                            scrollbarPosition: 'outside',
                            enable:true,
                            theme: 'dark',
                        },
                        theme: 'dark-thick',
                    });
                    $('#sidebar-content').mCustomScrollbar({
                        autoHideScrollbar: true,
                        contentTouchScroll: 25,
                        documentTouchScroll: true,
                        scrollInertia : 500,
                        scrollButtons:{
                            scrollbarPosition: 'outside',
                            enable:true,
                            theme: 'dark',
                        },
                        theme: 'dark-thick',
                    });
                });
            })(jQuery);
        ");
    ?>
<?php
$baseUrl = json_encode(Yii::$app->request->baseUrl . '/site/announcement?data=');
$upd = json_encode(DataCenter::countAnnouncement());
$pjaxInt = json_encode(Yii::$app->params['announcementInterval']);
$anc_pjax = <<< JS
    $(window).load(function(){
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
    <script type="text/javascript" >$('.datepicker').datepicker();</script>
</body>
</html>
<?php $this->endPage() ?>