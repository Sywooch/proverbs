<?php
use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;
use app\models\RequestDataAccess;
$this->title = 'Dashboard';
?>
<p></p>
<div class="ui two column stackable grid">
    <div class="twelve wide rounded column">
        <div class="ui raised segment">
            
        </div>
    </div>
    <div class="four wide column">
        <?= $this->render('_parents-request') ?>
    </div>
</div>
