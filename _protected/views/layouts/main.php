<?php
use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap\ButtonDropdown;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use yii\widgets\ListView;
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
            echo '<div id="header-offset"></div>';
            echo $content;
        } else { //MAIN
            include('header.php');
            echo '<div class="page-container">';
            include('sidebar.php');
            echo '<div class="page-content">';
            include('alert.php');
            echo $content . 
            '<div class="page-content-offset"></div>' .
                '</div>' .
            '</div>';
        }
    ?>
    <?php $this->endBody() ?>
    <?php include('script.php');?>
    <?php 
        /*if(Yii::$app->request->url !== '/proverbs/site/login' && Yii::$app->request->url !== '/proverbs/site/signup'){
            $this->registerJs("$('#fetch').click(handleAjaxLink);", View::POS_READY);
        }*/
    ?>
</body>
</html>
<?php $this->endPage() ?>