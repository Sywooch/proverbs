<?php
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
?>
<p></p>
<div class="user-view">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            'email:email',          
            'password_hash',
            [
                'attribute'=>'status',
                'value' => $model->getStatusName(),
            ],
            [
                'attribute'=>'item_name',
                'value' => $model->getRoleName(),
            ],
            'auth_key',
            'password_reset_token',
            'account_activation_token',
            'created_at:date',
            [
                'attribute' => 'updated_at',
                'value' => $model->getUpdatedAt($model->updated_at)
            ],
        ],
    ]) ?>
    <br/>
    <p>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'pull-right btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this user?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>
</div>
