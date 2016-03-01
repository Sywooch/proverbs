<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\NurseryFormSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Nursery Forms';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nursery-form-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Nursery Form', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //'id',
            //'grade_protection',
            'enrolled_id',
            //'grading_period',
/*            'core_value_1',
            'core_value_2',
            'core_value_3',
            'core_value_4',*/
            'subject_1',
            'subject_2',
            'subject_3',
            'subject_4',
            'subject_5',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
