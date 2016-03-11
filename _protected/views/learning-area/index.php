<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LearningAreaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Learning Areas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="learning-area-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Learning Area', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'grade_level_id',
            'subject_id',
            'sequence',
            'semester',
            // 'revision',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
