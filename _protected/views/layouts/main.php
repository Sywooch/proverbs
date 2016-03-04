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
        } elseif(Yii::$app->user->is('parent') === true) {
            include('header.php');
            echo '<div class="page-container">';
            include('sidebar.php');
            echo '<div class="page-content">' . '<div class="header-offset"></div>';
            include('page-header.php');
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
            echo '<div class="page-content">' . '<div class="header-offset"></div>';
            include('page-header.php');
            echo '<div class=row><div class="col-lg-12"><div class="breadcrumb-line">' . Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],]) . '</div></div></div>';
            echo $content;
            echo '<div class="page-content-offset"></div>';
            include('footer.php');
            echo '</div>' . // PAGE-CONTENT
            '</div>'; // PAGE-CONTAINER
            echo '<div id="messages">
                <div class="panel panel-default">
                    <div class="panel-heading">
                    <button id="new-board-message" class="pull-left"><span><i class="fa fa-wechat"></i></span></button>
                    <a id="btn-msg-toggle" class="btn btn-primary btn-board pull-right" href="#" style="text-align: center; margin: auto;"><i class="fa fa-remove fa-one-point-five"></i></a>
                    </div>
                    <div class="panel-body">
                        <div id="message-content-panel" class="board">
                            <div class="board-content">';
                            //BEGIN GET BOARD MESSAGES
                            Pjax::begin([
                                    'enablePushState' => false, 
                                    'enableReplaceState' => true, 
                                    'timeout' => 60000,
                                ]);
                                echo Html::a('<span id="refresh-btn" class="btn btn-xs"><i class="fa fa-refresh"></i></span>', [''], ['class' => 'btn btn-lg btn-primary hidden', 'id' => 'pjax-board']);
                                echo ListView::widget([
                                    'dataProvider' => $dataProviderBoard,
                                    'layout' => '{items} {pager}',
                                     'itemOptions' => ['class' => 'item'],
                                    'itemView' => '_messages',
                                ]);
                    
                                Pjax::end();
                            //END
                        echo '</div>
                        </div>
                    </div>
                    <div id="write-panel-footer" class="panel-footer" stlye="border: 1px solid blue;">';
                        $board = new Board();
                        Pjax::begin(['id' => 'pjax-write']);
                            $form = ActiveForm::begin(['options' => ['data-pjax' => true ]]);
                            echo '<div id="write-form-textarea">'
                                . $form->field($board, 'content', ['inputTemplate' => '{input}<button id="write-board-send" type="submit" class="btn btn-block btn-primary" style="margin-top: 10px;">SEND</button>'])->textarea(['maxlength' => true,'id' => 'write-textarea', 'class' => 'form-control', 'style' => 'margin: 0;', 'rows' => 1])->label(false)
                            . '</div>';
                            ActiveForm::end(); 
                        Pjax::end();
                    echo '</div>
                </div>
            </div>
            </div>';
            echo '<button id="toggle-board-menu" class="hvr-pulse"><i class="fa fa-wechat fa-2x"></i></button>';
        }
    ?>
    <?php $this->endBody() ?>
    <?php include('board-script.php');?>
    <?php include('script.php');?>
    <script src="/proverbs/themes/proverbs/js/sweetalert.min.js"></script>
</body>
</html>
<?php $this->endPage() ?>
