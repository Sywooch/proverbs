<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AssessmentFormSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Assessment Forms';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="assessment-form-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Assessment Form', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'enrolled_id',
            'tuition_id',
            /*
            'has_sibling_discount',
            'has_book_discount',
            'has_honor_discount',
            'sibling_discount',
            'book_discount',
            'honor_discount',*/
            'total_assessed',
            'balance',
            //'created_at',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
