 <?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\models\Card;
use app\models\Options;
use app\models\DataHelper;

/* @var $tris yii\web\View */
/* @var $model app\models\GradeOneForm */
/* @var $form yii\widgets\ActiveForm */
$this->title = DataHelper::name($models[0]->enrolled->student->first_name, $models[0]->enrolled->student->middle_name, $models[0]->enrolled->student->last_name);
$avatar = Yii::$app->request->baseUrl . Yii::$app->params['avatar'];
?>
<br>
<?php $form = ActiveForm::begin(); ?>
<div class="ui three column stackable grid">
    <div class="four wide rounded column">
        <?= Card::render($options = [
            'imageContent' => !empty($models[0]->enrolled->student->students_profile_image) ? Yii::$app->request->baseUrl . '/file?id=' . $models[0]->enrolled->student->students_profile_image : $avatar,
            'labelContent' => implode(' ', ['ID#', $models[0]->enrolled->student->id ]),
            'labelFor' => 'ID',
            'labelOptions' => '',
            'headerContent' => DataHelper::name($models[0]->enrolled->student->first_name, $models[0]->enrolled->student->middle_name, $models[0]->enrolled->student->last_name),
            'headerOptions' => '',
            'metaContent' => '&nbsp',
            'metaOptions' => '',
            'leftFloatedContent' => 'Grade 1',
            'leftFloatedFor' => 'Grade Level',
            'leftFloatedOptions' => '',
            'rightFloatedContent' => '',
            'rightFloatedOptions' => !$models[0]->enrolled->student->sped === 0 ? '<div class="ui star rating" data-max-rating="1"><div class="icon active" style="font-size:  16px;"></div></div>' : 'hidden'
        ]) ?>
    </div>
    <div class="nine wide rounded column">
        <div class="column">
            <div class="ui segment">
                <table class="ui celled striped small table">
                    <thead>
                        <tr>
                            <th>&nbsp;</th>
                            <th>First</th>
                            <th>Second</th>
                            <th>Third</th>
                            <th>Fourth</th>
                        </tr>
                    </thead>
                    <tbody id="grade-one-tbody">
                        <tr>
                            <td>English</td>
                            <?php foreach($models as $i=>$model): ?>
                                <td><?= $form->field($model,"[$i]subject_1", ['inputTemplate' => '{input}', 'inputOptions' =>['class' => 'form-control pva-form-control'] ], ['inputTemplate' => '{input}', 'inputOptions' =>['class' => 'form-control pva-form-control'] ])->label(false); ?></td>
                            <?php endforeach; ?>
                        </tr>
                        <tr>
                            <td>Math</td>
                            <?php foreach($models as $i=>$model): ?>
                                <td><?= $form->field($model,"[$i]subject_2", ['inputTemplate' => '{input}', 'inputOptions' =>['class' => 'form-control pva-form-control'] ])->label(false); ?></td>
                            <?php endforeach; ?>
                        </tr>
                        <tr>
                            <td>Science</td>
                            <?php foreach($models as $i=>$model): ?>
                                <td><?= $form->field($model,"[$i]subject_3", ['inputTemplate' => '{input}', 'inputOptions' =>['class' => 'form-control pva-form-control'] ])->label(false); ?></td>
                            <?php endforeach; ?>
                        </tr>
                        <tr>
                            <td>Civics</td>
                            <?php foreach($models as $i=>$model): ?>
                                <td><?= $form->field($model,"[$i]subject_4", ['inputTemplate' => '{input}', 'inputOptions' =>['class' => 'form-control pva-form-control'] ])->label(false); ?></td>
                            <?php endforeach; ?>
                        </tr>
                        <tr>
                            <td>Christian Education</td>
                            <?php foreach($models as $i=>$model): ?>
                                <td><?= $form->field($model,"[$i]subject_5", ['inputTemplate' => '{input}', 'inputOptions' =>['class' => 'form-control pva-form-control'] ])->label(false); ?></td>
                            <?php endforeach; ?>
                        </tr>
                        <tr>
                            <td>MTB</td>
                            <?php foreach($models as $i=>$model): ?>
                                <td><?= $form->field($model,"[$i]subject_6", ['inputTemplate' => '{input}', 'inputOptions' =>['class' => 'form-control pva-form-control'] ])->label(false); ?></td>
                            <?php endforeach; ?>
                        </tr>
                        <tr>
                            <td>MAPEH</td>
                            <?php foreach($models as $i=>$model): ?>
                                <td><?= $form->field($model,"[$i]subject_7", ['inputTemplate' => '{input}', 'inputOptions' =>['class' => 'form-control pva-form-control'] ])->label(false); ?></td>
                            <?php endforeach; ?>
                        </tr>
                        <tr>
                            <td>Filipino</td>
                            <?php foreach($models as $i=>$model): ?>
                                <td><?= $form->field($model,"[$i]subject_8", ['inputTemplate' => '{input}', 'inputOptions' =>['class' => 'form-control pva-form-control'] ])->label(false); ?></td>
                            <?php endforeach; ?>
                        </tr>
                        <tr>
                            <td>Makadiyos</td>
                            <?php foreach($models as $i=>$model): ?>
                                <td><?= $form->field($model,"[$i]core_value_1", ['inputTemplate' => '{input}', 'inputOptions' =>['class' => 'form-control pva-form-control'] ])->label(false); ?></td>
                            <?php endforeach; ?>
                        </tr>
                        <tr>
                            <td>Makatao</td>
                            <?php foreach($models as $i=>$model): ?>
                                <td><?= $form->field($model,"[$i]core_value_2", ['inputTemplate' => '{input}', 'inputOptions' =>['class' => 'form-control pva-form-control'] ])->label(false); ?></td>
                            <?php endforeach; ?>
                        </tr>
                        <tr>
                            <td>Makakalikasan</td>
                            <?php foreach($models as $i=>$model): ?>
                                <td><?= $form->field($model,"[$i]core_value_3", ['inputTemplate' => '{input}', 'inputOptions' =>['class' => 'form-control pva-form-control'] ])->label(false); ?></td>
                            <?php endforeach; ?>
                        </tr>
                        <tr>
                            <td>Makabansa</td>
                            <?php foreach($models as $i=>$model): ?>
                                <td><?= $form->field($model,"[$i]core_value_4", ['inputTemplate' => '{input}', 'inputOptions' =>['class' => 'form-control pva-form-control'] ])->label(false); ?></td>
                            <?php endforeach; ?>
                        </tr>
                    </tbody>
                </table>
            </div><!-- form -->
        </div>
    </div>
    <div class="three wide rounded column">
        <div class="column">
            <div class="ui fluid vertical menu">
                <div class="ui fluid huge label item">
                    <span>Options</span>
                </div>
                <div class="item">
                    <?= Html::submitButton('Save' , ['class' => 'ui link fluid huge primary submit button', 'style' => 'color: white;']) ?>
                    <br>
                    <?= Html::a(Yii::t('app', 'View'),['view', 'eid' => $eid], ['class' => 'ui link fluid huge teal button']) ?>
                    <br>
                    <?= Html::a(Yii::t('app', 'Cancel'),['/grade-one'], ['class' => 'ui link fluid huge grey button']) ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>
<?php $this->render('switch'); ?>
<?= $this->render('/layouts/_toast', ['model' => $model])?>
<?php
$this->registerJs("
    $('#grade-menu .ui.menu')
    .on('click', '.item', function() {
        $(tris).addClass('active').siblings('.item').removeClass('active');
        var sel = $(tris).attr('data-tab');
        var tab = $('.ui.tab.segment');
        var t = $('#grade-menu').find('[data-tab=\"' + sel + '\"]');
        $(t).addClass('active').removeClass('hidden').siblings('.ui.tab.segment').removeClass('active').addClass('hidden');
    });
");?>
