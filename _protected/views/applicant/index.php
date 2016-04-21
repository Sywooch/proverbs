<?php
use yii\helpers\Html;
use app\models\UiListView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ApplicantFormSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Applicants';
?>
<p></p>
<div class="ui two column stackable grid">
        <div class="twelve wide column">
            <div class="ui raised segment">
                <div class="ui black ribbon label" style="margin-left: -2px;">
                    <h4>Applicants</h4>
                </div>
                <div class="pull-right"><?= Html::a('<i class="icon plus"></i>',['create'],['class' => 'ui large green icon button']) ?></div>
                <p></p>
                <?php Pjax::begin(['id' => 'applicant-list', 'timeout' => 10000, 'enablePushState' => false]); ?>
                <?=
                    UiListView::widget([
                       'dataProvider' => $dataProvider,
                        'itemView' => '_list',
                    ]);    
                ?>
                <?php Pjax::end(); ?>
            </div>
        </div>
        <div class="four wide column">
            <?= $this->render('_search', ['model' => $searchModel]) ?>
        </div>
</div>
<?php
$pjax = <<< JS
$(document).ready(function(){
    setInterval(function(){
        $.pjax.reload({
            container:'#applicant-list',
            success: function(){
                $('ul.pagination > li.active > a').click()
            }
        });
    }, 10000);
});
JS;
$this->registerJs($pjax);
?>