<?php 
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\Announcement;
use app\models\UiListView;
use app\models\User;
use app\models\DataHelper;
$imaage = DataHelper::image(Yii::$app->user->identity->id);
$user = User::findOne(Yii::$app->user->identity->id);
?>
<?= $this->render('loading') ?>
<header style="z-index: 99;">
    <div id="nav-menu" class="ui top fixed secondary pointing menu">
        <?= $this->render('menu') ?>
        <div id="nav-menu-dropdown">
            <select class="form-control pva-form-control">
            </select>
        </div>
    </div>
        <div class="ui top fixed huge inverted menu">
            <div class="ui link item">
                <span><a href="<?= Yii::$app->request->baseUrl ?>"><img src="<?= Yii::$app->params['logo'] ?>" alt="Proverbs" class="ui mini avatar image"></a></span>
            </div>
            <div class="right floated small menu">
                <?php if(!Yii::$app->user->isGuest && app\rbac\models\AuthAssignment::getAssignment(Yii::$app->user->identity->id) !== 'parent' ): ?>
                <div id="new-announcement" class="ui link item" data-toggle="modal" data-target="#ann_modal">
                    <i class="icon-flag"></i>
                    <div class="notify announcement hidden"></div>
                </div>
                <?php endif ?>
                <div class="ui link top pointing dropdown item">
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
                        <a class="link item" href="<?= Yii::$app->request->baseUrl . '/settings' ?>">Settings<i class="right floated settings icon"></i></a>
                        <a class="link item" href="<?= Yii::$app->request->baseUrl . '/site/logout' ?>" style="border-top: 1px solid #e9e9e9;" data-method='post'>Signout<i class="right floated sign out icon"></i></a>
                    </div>
                </div>
            </div>
        </div>
</header>
<div id="nav-offset"></div>
<?php $this->registerJs("
    (function($){
        $(window).load(function(){
            
            $('.ui.pointing.dropdown.item').dropdown({
                transition: 'slide down',
            });

            var menu = $('#nav-menu > a');
            var dlist = $('#nav-menu-dropdown > select');
            var selected;

            $(menu).each(function(index, value){
                $(value).attr('class') === 'link item active' ? selected = 'selected' : selected = '';
                $(dlist).append('<option value=\"' + $(value).attr('href') + '\" ' + selected + '>' + $(value).text() + '</option>');
            });
            
            dlist.change(function(){
                window.location = $(this).val();
            });
        });
    })(jQuery);
");?>