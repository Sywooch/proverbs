<?php
use app\models\Card;
use app\models\DataHelper;
use app\models\StudentForm;
use app\models\UiTable;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$avatar = Yii::$app->request->baseUrl . Yii::$app->params['avatar'];
!$model->isNewRecord ? !empty($model->student->students_profile_image) ? $img = Yii::$app->request->baseUrl . '/file?id=' . $model->student->students_profile_image : $img = $avatar : '';
$card_url = json_encode(Yii::$app->request->baseUrl . '/site/card?data=');
?>

<?php $form = ActiveForm::begin(); ?>
<div class="ui three column stackable grid">
    <div class="four wide rounded column">
        <?= Card::render($options = [
            'imageContent' => !$model->isNewRecord ? $img : $avatar,
            'labelContent' => !$model->isNewRecord ? implode(' ', ['ID#', '<strong>', $model->student->id, '</strong>']) : '&nbsp;',
            'labelFor' => 'Enrollee ID',
            'labelOptions' => '',
            'headerContent' => !$model->isNewRecord ? implode(' ', [$model->student->first_name, $model->student->middle_name, $model->student->last_name]) : '&nbsp;',
            'headerOptions' => '',
            'metaContent' => !$model->isNewRecord ? implode('', ['\'', $model->student->nickname, '\'']) : '&nbsp',
            'metaOptions' => '',
            'leftFloatedContent' => !$model->isNewRecord ? DataHelper::gradeLevel($model->student->grade_level_id) : '&nbsp;',
            'leftFloatedFor' => 'Grade Level',
            'leftFloatedOptions' => '',
            'rightFloatedContent' => '',
            'rightFloatedOptions' => !$model->isNewRecord ? $model->student->sped === 0 ? '' : 'hidden' : 'hidden'
        ]) ?>
    </div>
    <div class="nine wide rounded column">
        <div class="ui segment">
            <?= !$model->isNewRecord ? Html::tag('label', implode('', [implode('-', array_map('ucfirst', explode('-', Yii::$app->controller->id))),'# ', $model->id, '<br><br>']), ['class' => 'ui fluid big label']) : '' ?>
            <div class="ui two column stackable grid">
                <div class="eight wide column">
                    <?= $form->field($model, 'transaction', ['inputTemplate' => '<div style="margin-top: 0;"><label style="padding: 0; color: #555; font-weight: 600;">Card</label><div class="pull-right">{input}</div></div>'])->checkbox($options = ['class' => 'js-switch', 'data-switchery' => true, 'value' => $model->isNewRecord ? 1 : $model->transaction])->label(false) ?>
                </div>
            </div>
            <div class="ui two column stackable grid">
                <div class="eight wide column">
                    <?= $model->isNewRecord ? $form->field($model, 'student_id', ['inputTemplate' => '<label style="padding: 0; color: #555; font-weight: 600;">Student</label>{input}', 'inputOptions' => ['class' => 'form-control pva-form-control', ] ])
                        ->widget(Select2::classname(), [
                            'data' => ArrayHelper::map(StudentForm::find()->orderBy(['first_name' => SORT_ASC])->all(),'id', function($model){
                                return implode(' ', [$model->first_name, $model->middle_name, $model->last_name]);
                            }),
                            'language' => 'en',
                            'options' => ['id' => 'auto-suggest','placeholder' => 'Select Student', 'class' => 'form-control pva-form-control'],
                            'size' => 'md',
                            'pluginOptions' => [
                                'allowClear' => true
                        ],
                        'pluginEvents' => [
                            'change' => "
                                function(){
                                    if($('#auto-suggest').val() === ''){
                                        console.log('empty');
                                        $('.tiny.image').attr('src', '/proverbs/uploads/ui/user-blue.svg');
                                        $('#header-label').html('&nbsp;');
                                        $('#header-content').html('&nbsp;');
                                        $('#meta-content').html('&nbsp;');
                                        $('#left-content').html('&nbsp;');
                                        $('#right-content').addClass('hidden');
                                    }else {
                                        $.ajax({
                                            type: 'POST',
                                            url: $card_url + JSON.stringify({sid:$('#auto-suggest').val(),}),
                                            contentType: 'application/json; charset=utf-8',
                                            dataType: 'json',
                                            success: function(data){

                                                $('#header-label').html('ID# ' + '<strong>' + data.sid + '</strong>');
                                                $('#header-content').html(data.name);
                                                $('#meta-content').html(data.nick);
                                                $('#left-content').html(data.level);

                                                if(data.spd === 0){
                                                    $('#right-content').removeClass('hidden');
                                                }

                                                if(data.img !== 'empty'){
                                                    $('.tiny.image').attr('src', data.img);
                                                }else {
                                                    $('.tiny.image').attr('src', '/proverbs/uploads/ui/user-blue.svg');
                                                }
                                            }
                                        });
                                    }
                                }
                            ",
                        ],
                    ])->label(false) : ''; ?>
                </div>
                <div class="eight wide column"></div>
            </div>
            <div class="ui two column stackable grid">
                <?php
                    if(!$model->isNewRecord){
                        echo '<div class="ui sixteen wide column">';
                        echo UiTable::widget([
                            'model' => $model,
                            'options' => ['class' => 'ui fixed very basic table'],
                            'attributes' => [
                                    [
                                        'attribute' => 'assessment_id',
                                        'value' => $model->assessment_id
                                    ],
                                    [
                                        'attribute' => 'student_id',
                                        'value' => DataHelper::name($model->student->first_name, $model->student->middle_name, $model->student->last_name)
                                    ],
                                    'paid_amount:currency',
                                    'created_at:date',
                                    'updated_at:date'
                                ]
                        ]);
                        echo '</div>';
                    }
                ?>
                <div class="eight wide column">

                    <?php if($model->isNewRecord ){
                            echo $form->field($model, 'paid_amount', ['inputTemplate' => '<label for="">Amount</label>{input}','inputOptions' => [] ])->label(false)->textInput(['id' => 'pa', 'class' => 'form-control pva-form-control', 'style' => 'text-align: right;', 'placeholder' => '0.00'], ['maxlength' => true]);
                        }
                    ?>
                </div>
                <div class="eight wide column">
                  <?= $form->field($model, 'payment_description', ['inputTemplate' => '<div style="margin-top: 0;"><label style="padding: 0; color: #555; font-weight: 600;">Description</label>{input}</div>'])->dropDownList([0 => 'Tuition Fee', 2 => 'Entrance Exam', 3 => 'Others'], ['class' => 'form-control pva-form-control'])->label(false) ?>
                </div>
            </div>
        </div>
    </div>
    <div class="three wide rounded column">
        <div class="column">
            <div class="ui fluid vertical menu">
                <div class="ui fluid huge label item">
                    <span>Options</span>
                </div>
                <div class="item">
                    <?= Html::submitButton($model->isNewRecord ? 'Add' : 'Save' , ['class' => 'ui link fluid huge primary submit button', 'style' => 'color: white;']) ?>
                    <p></p>
                    <?php if(!$model->isNewRecord): ?>
                    <?= Html::a(Yii::t('app', 'View'),['view', 'id' => $model->id], ['class' => 'ui link fluid huge teal button']) ?>
                    <p></p>
                    <?php endif ?>
                    <?= Html::a(Yii::t('app', 'Cancel'),['/enroll'], ['class' => 'ui link fluid huge grey button']) ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->render('/layouts/switch') ?>
<?php ActiveForm::end(); ?>
