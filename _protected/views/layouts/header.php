<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="navbar-header">
        <a class="navbar-brand" href="#"><img src="<?= Yii::$app->request->baseUrl . '/themes/proverbs/' ?>images/pvcf-temp.png" alt="Proverbsville Academy"></a>
        <a class="sidebar-toggle"><i class="icon-paragraph-justify2"></i></a>
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-icons">
            <span class="sr-only">Toggle navbar</span>
            <i class="icon-grid3"></i>
        </button>
        <button type="button" class="navbar-toggle offcanvas">
            <span class="sr-only">Toggle navigation</span>
            <i class="icon-paragraph-justify2"></i>
        </button>
    </div>
    <ul id="navbar-icons" class="nav navbar-nav navbar-right collapse">
        <li class="user dropdown">
            <a href="#" class="dropdown-toggle btn-popover" data-container="body" data-toggle="popover" data-placement="bottom" data-html="true" 
                data-content="
                    <div id='user-dropdown-options'>
                        <ul>
                            <li><a href='<?= Yii::$app->request->baseUrl . '/dashboard' ?>'>Dashboard <i class='icon-cog'></i></a></li>
                            <li><a href='<?= Yii::$app->request->baseUrl . '/profile' ?>'>Profile <i class='icon-user'></i></a></li>
                            <li><a href='<?= Yii::$app->request->baseUrl . '/board' ?>'>Messages <i class='icon-bubble4'></i></a></li>
                            <li><a href='<?= Yii::$app->request->baseUrl . '/site/logout' ?>' data-method='post'>Logout <i class='icon-exit'></i></a></li>
                        </ul>
                    </div>">
                <?php
                    if(!Yii::$app->user->isGuest){
                        if(!empty(Yii::$app->user->identity->profile_image)){
                            echo '<img id="user-profile-img-thumb" class="rounded-edge" src="/proverbs/uploads/users/' . Yii::$app->user->identity->profile_image .'">';
                        }else {
                            echo '<img id="user-profile-img-thumb" class="rounded-edge" src="/proverbs/uploads/ui/user-blue.png">';
                        }
                    }
                ?> 
                <span><?= !Yii::$app->user->isGuest ? ucfirst(Yii::$app->user->identity->username) : '' ?></span>
                <span id="dropdown-caret"><i class="caret open"></i></span>
            </a>
        </li>
    </ul>
</div>