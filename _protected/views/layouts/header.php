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
            <a href="#" class="dropdown-toggle btn-popover" data-trigger="focus" data-container="body" data-toggle="popover" data-placement="bottom" data-html="true" 
                data-content="
                    <div id='user-dropdown-options'>
                        <ul>
                            <li><a href='<?= Yii::$app->request->baseUrl . '/profile' ?>'><i class='icon-user'></i> Profile</a></li>
                            <li><a href='<?= Yii::$app->request->baseUrl . '/board' ?>'><i class='icon-bubble4'></i> Messages</a></li>
                            <li><a href='#'><i class='icon-cog'></i> Settings</a></li>
                            <li><a href='<?= Yii::$app->request->baseUrl . '/site/logout' ?>' data-method='post'><i class='icon-exit'></i> Logout</a></li>
                        </ul>
                    </div>">
                <img id="" src="/proverbs/themes/proverbs/images/ricmil.jpg">
                <span><?= ucfirst($un) ?></span>
                <span><i class="caret"></i></span>
            </a>
        </li>
    </ul>
</div>