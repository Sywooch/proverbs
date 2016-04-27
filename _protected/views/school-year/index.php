<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SchoolYearSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'School Years';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="school-year-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create School Year', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'sy',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
