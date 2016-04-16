<?php
use app\helpers\CssHelper;
use yii\helpers\Html;
use app\models\GridView2;
use yii2mod\alert\Alert;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Users');

CONST ACTIVE = 10;
CONST INACTIVE = 1;

?>
<p></p>
<div class="user-form-index">
    <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-12">
            <div class="panel panel-default rounded-edge">
                <div class="panel-body ">
                    <div class="pull-right" style="margin-bottom: 10px;"><?= Html::a('<i class="fa fa-plus" style="margin-top: 3px;"></i> New', ['create'], ['class' => 'btn btn-md btn-success']) ?></div>
                    <h4>Users</h4>
                    <hr class="hr-full-width">
                    <?php
                        // Alert::widget([
                        //         'type' => Alert::TYPE_WARNING,
                        //         'options' => [
                        //             'title' => 'Title',
                        //             'text' => "Test",
                        //             'confirmButtonText'  => "Yes, delete it!",
                        //             'cancelButtonText' =>  "No, cancel plx!"
                        //         ]
                        // ]);
                    ?>
                    <?= GridView2::widget([
                        'dataProvider' => $dataProvider,
                        //'filterModel' => $searchModel,
                        'layout'=>"<div class='text-centered'>{pager}</div>{items}<div class='text-centered'>{pager}</div>",
                        'columns' => [
                            [
                                'format' => 'html',
                                'header' => '',
                                'attribute' => 'username',
                                'value' => function($model){

                                    if(!empty($model->profile_image) || $model->profile_image !== null){
                                        $img = Yii::$app->request->baseUrl . '/uploads/profile-img/' . $model->profile_image;
                                    }else {
                                        $img = Yii::$app->request->baseUrl . '/uploads/ui/user-blue.png';
                                    }

                                    $model->gender === 0 ? $gender = 'Male <i class="fa fa-mars fa-one-half"></i>' : $gender = 'Female <i class="fa fa-venus fa-one-half"></i>';
                                    $url = Yii::$app->request->baseUrl . '/user/view?id=';
                                    $edit = Yii::$app->request->baseUrl . '/user/update?id=';
                                    $delete = Yii::$app->request->baseUrl . '/user/delete?id=';
                                    $state = $model->status;

                                    if($state === ACTIVE){
                                        $halo = 'active';
                                    }elseif($state === INACTIVE){
                                        $halo = 'inactive';
                                    }else{
                                        $halo = 'deleted';
                                    }

                                    if($model->role->item_name === 'dev'){
                                        $type = 'square-badge dev-badge';
                                    } elseif($model->role->item_name === 'master'){
                                        $type = 'square-badge master-badge';
                                    } elseif($model->role->item_name === 'admin'){
                                        $type = 'square-badge admin-badge';
                                    } elseif($model->role->item_name === 'cashier'){
                                        $type = 'square-badge cashier-badge';
                                    } elseif($model->role->item_name === 'principal'){
                                        $type = 'square-badge principal-badge';
                                    } elseif($model->role->item_name === 'staff'){
                                        $type = 'square-badge staff-badge';
                                    } elseif($model->role->item_name === 'teacher'){
                                        $type = 'square-badge teacher-badge';
                                    } else {
                                        $type = 'square-badge parent-badge';
                                    }
                                    
                                    $role = '<div class="gridview-role-type"><div class="' . $type . '"><span>' . substr(ucfirst($model->role->item_name), 0, 1) . '</span></div></div>';

                                    $data = '
                                            <div class="row">'.
                                                '<div class="col-lg-1 col-md-1 col-sm-12">'
                                                    .  $role . 
                                                    '<p></p>' .
                                                        Html::a('<i class="fa fa-pencil fa-one-point-five fa-gridview"></i>', $edit . $model->id, ['title'=>'Edit', 'class' => 'gridview-edit-btn-wrap']) .  
                                                '</div>
                                                <div class="col-lg-2 col-md-2 col-sm-12">
                                                    <div class="gridview-user-wrap">
                                                        <div class="gridview-user-thumb">
                                                            <a href="' . $url . $model->id . '">
                                                                <img class="circle" src="' . $img . '" alt="' . $model->username . '">
                                                            </a>
                                                            <div class="user-halo-state ' . $halo .'"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-9 col-md-9 col-sm-12" style="margin-top: 20px;">
                                                    <div class="gridview-block text-centered">
                                                        <div class="gridview-info username">'. Html::a($model->username, $url . $model->id, ['title'=>'View User']) . '</div>
                                                        <div class="gridview-info email">'. $model->email .'</div>
                                                        <div class="gridview-info gender">'. $gender .'</div>
                                                    </div>
                                                </div>
                                            </div>';
                                    return $data;
                                }
                            ],
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-12">
            <div class="panel panel-default rounded-edge">
                <div class="panel-body">
                    <?= $this->render('_search', ['model' => $searchModel]) ?>
                </div>
            </div>
        </div>
    </div>
</div>
