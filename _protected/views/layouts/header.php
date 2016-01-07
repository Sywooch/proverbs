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

    <ul class="nav navbar-nav navbar-right collapse" id="navbar-icons">
        <li class="user dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown">
                <img src="/proverbs/themes/proverbs/images/ricmil.jpg">
                <span><?= ucfirst($un) ?></span>
                <i class="caret"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-right icons-right">
                <li><a href="<?= Yii::$app->request->baseUrl . '/profile' ?>"><i class="icon-user"></i> Profile</a></li>
                <li><a href="#"><i class="icon-bubble4"></i> Messages</a></li>
                <li><a href="#"><i class="icon-cog"></i> Settings</a></li>
                <li><a href="<?= Yii::$app->request->baseUrl . '/site/logout' ?>" data-method="post"><i class="icon-exit"></i> Logout</a></li>
            </ul>
        </li>
    </ul>
</div>