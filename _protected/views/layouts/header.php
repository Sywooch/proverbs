<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\Announcement;
use app\models\UiListView;
use app\models\User;
use yii\widgets\Pjax;
use app\models\DataHelper;
use app\models\DataCenter;
use app\rbac\models\AuthAssignment;
$imaage = DataHelper::image(Yii::$app->user->identity->id);
$user = User::findOne(Yii::$app->user->identity->id);
?>
<?= $this->render('loading') ?>
<header style="z-index: 99;">
    <?php if(AuthAssignment::getAssignment(Yii::$app->user->identity->id) !== 'parent') :  ?>
    <div id="nav-menu" class="ui top fixed secondary pointing menu">
        <?= $this->render('menu') ?>
        <div id="nav-menu-dropdown">
            <select class="form-control pva-form-control">
            </select>
        </div>
    </div>
    <?php endif ?>
        <div class="ui top fixed huge inverted menu">
            <div class="ui link item">
                <span><a href="<?= Yii::$app->request->baseUrl ?>"><img src="<?= Yii::$app->params['logo'] ?>" alt="Proverbs" class="ui mini avatar image"></a></span>
            </div>
            <div class="right floated small menu">
                <?php if(!Yii::$app->user->isGuest && app\rbac\models\AuthAssignment::getAssignment(Yii::$app->user->identity->id) !== 'parent' ): ?>
                <div id="new-announcement" class="ui top pointing dropdown item">
                    <i class="icon-flag"></i>
                    <div class="notify announcement hidden"></div>
                    <?= $this->render('announcement') ?>
                </div>
                <?php endif ?>
                <div class="ui link dropdown item">
                    <?= Html::img(
                        Yii::$app->user->isGuest
                            ? Yii::$app->request->baseUrl . Yii::$app->params['avatar']
                                : !empty(Yii::$app->user->identity->profile_image)
                                    ? Url::to(['/uthumbnail', 'id' => Yii::$app->user->identity->profile_image])
                                        : Yii::$app->request->baseUrl . Yii::$app->params['avatar']
                    , ['id' => 'thumbnail', 'style' => 'background: #f7f7f7;', 'class' => 'ui right thumbnail image', 'alt' => Yii::$app->user->identity->username])
                        . Html::tag('span', Yii::$app->user->identity->username . '<i class="dropdown icon" style="color: white; margin: 0 5px;"></i>', ['style' => 'margin: auto 10px; color: white;'])
                    ?>

                    <div class="menu" style="min-width: 180px; margin-right: 5px; margin-top: 0; border-radius: 0;">
                        <a class="link item" href="<?= Yii::$app->request->baseUrl . '/dashboard' ?>">Dashboard<i class="right floated dashboard icon"></i></a>
                        <a class="link item" href="<?= Yii::$app->request->baseUrl . '/profile' ?>">Profile<i class="right floated user icon"></i></a>
                        <!-- <a class="link item" href="<?php //Yii::$app->request->baseUrl . '/settings' ?>">Settings<i class="right floated settings icon"></i></a> -->
                        <a class="link item" href="<?= Yii::$app->request->baseUrl . '/site/logout' ?>" style="border-top: 1px solid #e9e9e9;" data-method='post'>Signout<i class="right floated sign out icon"></i></a>
                    </div>
                </div>
            </div>
        </div>
</header>
<?= AuthAssignment::getAssignment(Yii::$app->user->identity->id) !== 'parent' ?
    Html::tag('div','', ['id' => 'nav-offset']) : Html::tag('div','', ['style' => 'min-height: 56px;'])
?>
<?php if(AuthAssignment::getAssignment(Yii::$app->user->identity->id) === 'parent') :  ?>
    <div id="parent-menu-wrap">
        <div class="ui container">
            <div id="nav-menu-parent" class="ui secondary menu" style="padding: 5px 0;">
                <?= $this->render('menu') ?>
                <div id="nav-menu-dropdown">
                    <select class="form-control pva-form-control">
                    </select>
                </div>
            </div>
        </div>
    </div>
<?php endif ?>
<?php $this->registerJs("
    (function($){
        $(window).load(function(){

            $('.ui.dropdown.item').dropdown({
                transition: 'slide down',
            });

            var menu = $('#nav-menu > a');
            var menu2 = $('#nav-menu-parent > a');
            var dlist = $('#nav-menu-dropdown > select');
            var selected;

            $(menu).each(function(index, value){
                $(value).attr('class') === 'link item active' ? selected = 'selected' : selected = '';
                $(dlist).append('<option value=\"' + $(value).attr('href') + '\" ' + selected + '>' + $(value).text() + '</option>');
            });

            $(menu2).each(function(index, value){
                $(value).attr('class') === 'item active' ? selected = 'selected' : selected = '';
                $(dlist).append('<option value=\"' + $(value).attr('href') + '\" ' + selected + '>' + $(value).text() + '</option>');
            });

            dlist.change(function(){
                window.location = $(this).val();
            });
        });
    })(jQuery);
");?>
