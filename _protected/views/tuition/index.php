<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TuitionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tuitions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tuition-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Tuition', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'grade_level_id',
            'enrollment',
            'admission',
            'tuition_fee',
            'misc_fee',
            'ancillary',
            'monthly',
            'books',           
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
