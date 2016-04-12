<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Detailview;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SectionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sections';
$this->params['breadcrumbs'][] = $this->title;
?>
<p></p>
<div class="section-index">
    <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="pull-right"><?= Html::a('<div class="text-centered"><i class="fa fa-plus" style="margin-top: 3px;"></i> New</div>', ['create'], ['class' => 'btn btn-success']) ?></div>
                    <h4>Sections</h4>
                    <hr class="hr-full-width">
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        //'filterModel' => $searchModel,
                        'layout'=>"<div class='gridview-summary'>{summary}</div>{items}<div class='text-centered'>{pager}</div>",
                        'columns' => [
                            [
                                'attribute' => 'section_name',
                                'format' => 'html',
                                'value' => function($model){
                                    if(strlen($model->levelName) === 1){
                                        return '<table class="gridview-section-items"><tr><td><div class="gridview-level-name one-char"><span>' . $model->levelName  . '</span></div></td><td>' . $model->section_name . '</td></tr></table>';
                                    } elseif(strlen($model->levelName) === 2) {
                                        return '<table class="gridview-section-items"><tr><td><div class="gridview-level-name two-char"><span>' . $model->levelName  . '</span></div></td><td>' . $model->section_name . '</td></tr></table>';
                                    } elseif(strlen($model->levelName) === 3) {
                                        return '<table class="gridview-section-items"><tr><td><div class="gridview-level-name three-char"><span>' . $model->levelName  . '</span></div></td><td>' . $model->section_name . '</td></tr></table>';
                                    } elseif(strlen($model->levelName) === 5) {
                                        $str = $model->levelName;
                                        $char = substr($str, 4);
                                        $str = substr($str, 0, 3);
                                    
                                        return '<table class="gridview-section-items"><tr><td><div class="gridview-level-name five-char"><span>' . $str . '<sub>' . $char .'</sub></span></div></td><td>' . $model->section_name . '</td></tr></table>';
                                    }
                                }
                            ],

                        ],
                    ]); ?>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <?= $this->render('_search', ['model' => $searchModel, 'listData' => $listData]); ?>
                </div>
            </div>
        </div>
    </div>
</div>
