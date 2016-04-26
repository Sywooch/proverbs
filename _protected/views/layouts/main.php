<?php
use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap\ButtonDropdown;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use yii\widgets\ListView;
use app\models\Board;
use app\models\BoardSearch;
use yii\bootstrap\ActiveForm;
use yii\web\View;
AppAsset::register($this);
?>
<?php
    if(!Yii::$app->user->isGuest){
        $role = app\rbac\models\AuthAssignment::getAssignment(Yii::$app->user->identity->id);
    }
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
<body <?= Yii::$app->request->url === '/proverbs/site/login' || Yii::$app->request->url === '/proverbs/site/signup' || Yii::$app->request->url === '/proverbs/login' || Yii::$app->request->url === '/proverbs/signup' ? 'style="display:table;"' : 'class=""';?>>
    <?php $this->beginBody() ?>
        <?php
            if(Yii::$app->request->url === '/proverbs/site/login' || Yii::$app->request->url === '/proverbs/login')
                include('alert.php');
        ?>
        </div>
    <?php
        if(Yii::$app->user->isGuest){
            echo $content;
        } elseif($role === 'parent') {
            include('header.php');
            echo '<div class="page-container">';
            include('sidebar.php');
            echo '<div class="page-content">' . '<div class="header-offset"></div>';
            //include('page-header.php');
            echo '<div class=row><div class="col-lg-12"><div class="breadcrumb-line">' . Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],]) . '</div></div></div>';
            echo $content;
            echo '<div class="page-content-offset"></div>';
            include('footer.php');
            echo '</div>' . // PAGE-CONTENT
            '</div>'; // PAGE-CONTAINER
        } else {
            include('header.php');
            echo '<div class="page-container">';
            include('sidebar.php');
            echo '<div class="page-content"><div id="header-offset"></div>';
            include('alert.php');
            //include('page-header.php');
            //echo '<div class=row><div class="col-lg-12"><div class="breadcrumb-line">' . Breadcrumbs::widget(['homeLink' => ['label' => 'Dashboard', 'url' => Yii::$app->request->baseUrl . '/dashboard'],'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],]) . '</div></div></div>';
            // echo    '<div class="row">
            //             <div class="col-lg-12 col-md-12 col-sm-12">
            //                 <div class="breadcrumb-line">' . 
            //                     Breadcrumbs::widget(['homeLink' => ['label' => 'Dashboard', 'url' => Yii::$app->request->baseUrl . '/dashboard'],'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],]) . 
            //                 '</div>
            //             </div>
            //         </div>' ;
            echo $content;
            echo '<div class="page-content-offset"></div>';
            include('footer.php');
            echo '</div>' . // PAGE-CONTENT
            '</div>'; // PAGE-CONTAINERa
                    //$role !== 'parent' ? require('_messages.php') : '';
                    //$role !== 'parent' ? require('_write.php') : '';
                    echo '</div>
                </div>
                </div>
             </div>';
            //echo '<button id="toggle-board-menu"><i class="fa fa-wechat fa-2x"></i></button>';
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