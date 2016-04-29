<?php 
use yii\helpers\Html;
?>
<div class="row">
    <div class="ui container">
        <div class="ui top fixed huge borderless inverted menu">
            <a class="navbar-toggle offcanvas" style="padding-right: 25px; padding-top: 0; padding-bottom: 0; position: fixed; top: 8px; left: 6px; z-index: 9999">
                <span class="sr-only">Toggle navigation</span>
                <i class="icon-menu" style="color: #fff;"></i>
            </a>
            <div class="ui left floated link item sidebar-toggle-menu" style="min-width: 54px;">
                <a id="trigger-sidebar"><i class="icon-menu" style="color: #fff;"></i></a>
            </div>
            <div class="center aligned text">
                <span><?=  Html::a(Html::img(Yii::$app->request->baseUrl . '/uploads/logo/proverbs.svg',['class' => 'ui mini avatar image', 'style' => 'padding-top: 12px;']), Yii::$app->request->baseUrl, []) ?></span>
            </div>
            <div class="right floated small menu">
                <div class="ui link top right pointing dropdown item">
                    <?= Html::img(
                        Yii::$app->user->isGuest 
                            ? Yii::$app->request->baseUrl . Yii::$app->params['avatar'] 
                                : !empty(Yii::$app->user->identity->profile_image) 
                                    ? Yii::$app->request->baseUrl . '/uploads/users/' . Yii::$app->user->identity->profile_image 
                                        : Yii::$app->request->baseUrl . Yii::$app->params['avatar']
                    , ['id' => 'thumbnail', 'style' => 'background: #f7f7f7;', 'class' => 'ui right thumbnail image', 'alt' => Yii::$app->user->identity->username]) ?>
                    <div class="menu" style="min-width: 180px; margin-right: 5px; margin-top: 5px; border-radius: 4px;">
                        <a class="link item" href="<?= Yii::$app->request->baseUrl . '/dashboard' ?>">Dashboard<i class="right floated dashboard icon"></i></a>
                        <a class="link item" href="<?= Yii::$app->request->baseUrl . '/profile' ?>">Profile<i class="right floated user icon"></i></a>
                        <a class="link item" href="<?= Yii::$app->request->baseUrl . '/settings' ?>">Settings<i class="right floated settings icon"></i></a>
                        <a class="link item" href="<?= Yii::$app->request->baseUrl . '/site/logout' ?>" data-method='post'>Signout<i class="right floated sign out icon"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<br>
<br>
<br>
<?php 
$this->registerJs("
    $(document).ready(function(){
        $('.ui.link.top.right.pointing.dropdown.item').dropdown({
            transition: 'slide down',
        });
    });
");
?>