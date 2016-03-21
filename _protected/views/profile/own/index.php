<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ProfileFormSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title =  'Profile';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-form-index">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <p class="pull-right">
                <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            </p>
        </div>
        <div class="panel panel-profile">
            <div class="panel-body" style="padding-left: 0; margin-top: 30px;">
                <div id="profile-img-wrapper" class="col-lg-3 col-md-3 col-sm-12">
                    <div class="profile-head">
                        <img src="<?= $model->profile_image === $model->id .'.jpg' ? Yii::$app->request->baseUrl . '/uploads/profile-img/' .  $model->profile_image : Yii::$app->request->baseUrl . '/uploads/user-thumb/male.png' ?>" alt="foto">
                        <p></p>
                        <span class="profile-data"><?= $model->username ?></span>
                        <p class="profile-user-icon"><i class="fa fa-user fa-2x"></i></p>                        
                    </div>
                        <p>&nbsp;</p>
                </div>
                <div id="profile-details-wrapper" class="col-lg-9 col-md-9 col-sm-12">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'first_name',
                            'middle_name',
                            'last_name',
                            [
                                'attribute' => 'gender',
                                'value' => $model->gender === 0 ? 'Male' : 'Female'
                            ],
                            'birth_date:date',
                            'email',
                            'address',
                            'phone',
                            'mobile',
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        
    </div>
</div>