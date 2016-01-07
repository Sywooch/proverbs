<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

$this->title = 'Page Not Found';
?>
<div id="error-404">
    <div class="container">
        <div class="row improv-border"> 
            <div class="row text-centered">
                <div class="col-lg-12 col-md-12 col-sm-12 blue-box " style="min-width:240px;">
                    <h1 class="error-404-heading">ERROR</h1>
                </div>
            </div>
        </div>
        <div class="row"> 
            <div class="row text-centered">
                <div class="col-lg-4 col-md-4 col-sm-12 yellow-box" style="min-width:240px;">
                    <h1 class="error-404-heading">4</h1>
                </div><div class="col-lg-4 col-md-4 col-sm-12 red-box "style="min-width:240px;">
                    <h1 class="error-404-heading">0</h1>
                </div><div class="col-lg-4 col-md-4 col-sm-12 green-box " style="min-width:240px;">
                    <h1 class="error-404-heading">4</h1>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="row message improv-border">
                <div class="text-centered">
                    <div class="col-lg-8 col-md-8 col-sm-12 blue-box" style="min-width:240px;">
                        <h2 class="error-404-subheading">Page Not Found</h2>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 red-box" style="min-width:240px;">
                        <a href="<?= Yii::$app->request->baseUrl . '/' ?>"><i id="error-404-home" class="fa fa-home fa-4x"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
