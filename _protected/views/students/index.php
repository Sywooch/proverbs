<?php
use yii\helpers\Html;
use app\models\UiListView;
use app\helpers\CssHelper;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ApplicantFormSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Students';
?>
<p></p>
<div class="ui two column stackable grid">
        <div class="twelve wide rounded column">
            <div class="panel panel-default">
                <div class="panel-body">
                <div class="pull-left"><h4>Students</h4></div>
                <div class="pull-right"><a href="students/create" class="ui large green circular icon button"><i class="icon plus"></i></a></div>
                <br>
                <?=
                    UiListView::widget([
                       'dataProvider' => $dataProvider,
                        'itemView' => '_list',
                    ]);    
                ?>
                </div>
            </div>
        </div>
        <div class="four wide column">
            <div class="panel panel-default">
                <div class="panel-body">
                    af
                </div>
            </div>
        </div>
</div>