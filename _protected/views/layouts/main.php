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
<body <?= Yii::$app->request->url === '/proverbs/site/login' || Yii::$app->request->url === '/proverbs/site/signup' || Yii::$app->request->url === '/proverbs/site/request-password-reset' ? 'style="display:table; overflow-y: hidden;"' : '';?> class="<?= Yii::$app->session->get('sidebar') ?>">
    <?php $this->beginBody() ?>
        <?php if(Yii::$app->request->url === '/proverbs/site/login' || Yii::$app->request->url === '/proverbs/login'){include('alert.php');}?>
        </div>
    <?php
        if(Yii::$app->user->isGuest){
            echo $content;
        } elseif(app\rbac\models\AuthAssignment::getAssignment(Yii::$app->user->identity->id) === 'parent') {
            include('header.php');
            include('alert.php');
            echo '<div class="ui container">';
            echo $content;
            echo '</div>';
        } else { //MAIN
            include('alert.php');
            include('header.php');
            
            if(Yii::$app->controller->id !== 'board'){
                include('sidebar.php');
            } else {
                include('board-messages.php');
            }
            
            echo '<div id="st" class="page-content smooth"><p></p>';
            echo $content;
            echo '</div>';
            include('announcement.php');
            include('pull.php');
        }
    ?>
    <?php $this->registerJs("$('.ui.left.vertical.menu.sidebar').sidebar('setting', 'transition', 'push').sidebar('attach events', '#trigger-sidebar, #sb-btn2', 'toggle');");?>
    <?php $this->endBody() ?>
    <?php $rst_url = json_encode(Yii::$app->request->baseUrl . '/site/reset') ?>
    <?php $this->registerJs("
        (function($){
            $(window).load(function(){
                //$('.datepicker').datepicker();
                
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
    "); ?>
</body>
</html>
<?php $this->endPage() ?>