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
use yii\widgets\Pjax;

$searchBoardModel = new BoardSearch();
$dataProviderBoard = $searchBoardModel->searchBoard(Yii::$app->request->queryParams);
AppAsset::register($this);
?>

<?php
$fn = '';
$un = '';
    if(!Yii::$app->user->isGuest){
        $fn = Yii::$app->user->identity->first_name . ' ' . Yii::$app->user->identity->last_name;
        $un = Yii::$app->user->identity->username;
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
        } else {
            include('header.php');
            echo '<div class="page-container">';
                include('sidebar.php');
                echo '<div class="page-content">' . '<div class="header-offset"></div>';
                include('page-header.php');
                echo '<div class=row><div class="col-lg-8"><div class="breadcrumb-line">' . Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],]) . '</div></div></div>';
                echo $content;
                echo '<div class="page-content-offset"></div>';
                include('footer.php');
                echo '</div>' . // PAGE-CONTENT
                '</div>'; // PAGE-CONTAINER
                echo Yii::$app->user->is('parent') === true ? 
                    '' : 
                    '<div id="messages">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                            <button id="new-board-message" class="pull-left"><span><i class="fa fa-wechat"></i></span></button>
                            <a id="btn-msg-toggle" class="btn btn-primary btn-board pull-right" href="#" style="text-align: center; margin: auto;"><i class="fa fa-angle-down fa-one-point-five"></i></a>
                            </div>
                            <div class="panel-body">
                                <div id="message-content-panel" class="board">
                                    <div class="board-content">';

                                        Pjax::begin([
                                            'enablePushState' => false, 
                                            'enableReplaceState' => true, 
                                            'timeout' => 2000,
                                        ]);
                                        echo Html::a('<span id="refresh-btn" class="btn btn-xs"><i class="fa fa-refresh"></i></span>', [''], ['class' => 'btn btn-lg btn-primary hidden', 'id' => 'pjax-board']);
                                        echo ListView::widget([
                                            'dataProvider' => $dataProviderBoard,
                                            'layout' => '{items} {pager}',
                                             'itemOptions' => ['class' => 'item'],
                                            'itemView' => '_messages',
                                        ]);
                            
                                        Pjax::end();

                                echo '</div>
                                </div>
                            </div>
                            <div class="panel-footer">
                                <div id="write-form-textarea">
                                    <textarea id="write-textarea" type="text" class="form-control" style="margin: 0;" rows="1"></textarea>
                                </div>
                                <div id="write-button-container">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <button type="submit" id="write-submit-btn" class="btn btn-block btn-primary">SEND</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>';
        }
    ?>
<?php
$script = <<< JS
$(document).ready(function() {

    $('#new-board-message').click(function(){
            scrollBottom();
        }
    );

    function scrollPos()
    {
        $("#message-content-panel").scroll(function(){
            //console.log('value: ' + ($("#message-content-panel").scrollTop() - $("#message-content-panel").offset().top));
            return $("#message-content-panel").scrollTop() - $("#message-content-panel").offset().top;
        });
    }

    function scrollBottom()
    {
        $("#message-content-panel").scrollTop($("#message-content-panel")[0].scrollHeight);
    }

    function reloadLink()
    {
        $("#pjax-board").click();
    }

    function focus()
    {
        $(document).on('ready pjax:success', function() {

            var focused = $("#write-textarea").is(":focus");
            
            $('#scroll-to-new-post').click(function(){
                    scrollBottom();
                }
            );

            if(focused === true){
                $('#write-textarea').focus();
            }
        });
    }

    scrollPos();
    scrollBottom();

    setInterval(function(){
        reloadLink();
        focus();
    }, 10000);

});
JS;
$this->registerJs($script);
?>
    <?php $this->endBody() ?>
    <?php include('script.php');?>
    <script src="/proverbs/themes/proverbs/js/sweetalert.min.js"></script>
</body>
</html>
<?php $this->endPage() ?>
