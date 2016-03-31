<?php
/**
 * -----------------------------------------------------------------------------
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 * -----------------------------------------------------------------------------
 */

namespace app\assets;

use yii\web\AssetBundle;
use Yii;

// set @themes alias so we do not have to update baseUrl every time we change themes
Yii::setAlias('@themes', Yii::$app->view->theme->baseUrl);

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * 
 * @since 2.0
 *
 * Customized by Nenad Živković
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@themes';

    public $css = [
        'css/animated.css',
        'css/bootstrap.min.css',
        'css/datepicker.css',
        'css/font-awesome.css',
        'css/hover-min.css',
        'css/icons.min.css',
        'css/style-dashboard.css',
        'css/style.css',
        'css/jan.css',
        'css/jan-responsive.css',
        'css/form-background.css',
        'css/switchery.css',
    ];

    public $depends = [
        'yii\web\YiiAsset',
    ];

    public $js = [
        'js/jquery-ui.min.js',
        'js/bootstrap.min.js',
        'js/init.js',
        'js/pva.js',
        //'js/switchery.js',
        'js/switchery.min.js',
        'js/switchery-init.js',
    ];

}
