<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\GradeFourFormSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Grade Four Forms';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="grade-four-form-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Grade Four Form', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'grade_protection',
            'enrolled_id',
            'grading_period',
            'core_value_1',
            // 'core_value_2',
            // 'core_value_3',
            // 'core_value_4',
            // 'subject_1',
            // 'subject_2',
            // 'subject_3',
            // 'subject_4',
            // 'subject_5',
            // 'subject_6',
            // 'subject_7',
            // 'subject_8',
            // 'subject_9',
            // 'subject_10',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
