<?php
use yii\helpers\ArrayHelpers;
use yii\helpers\Html;
use app\models\UiTable;

$def = Yii::$app->request->baseUrl . '/uploads/ui/user-blue.png';
!empty($model->students_profile_image) ? $img = Yii::$app->request->baseUrl . '/uploads/students/' . $model->students_profile_image : $img = $def;
!empty($model->guardians_profile_image) ? $g = Yii::$app->request->baseUrl . '/uploads/guardians/' . $model->guardians_profile_image : $g = $def;
$model->gender === 0 ? $gender = 'Male <i class="man icon"></i>' : $gender = 'Female <i class="woman icon"></i>';
!empty(trim($model->middle_name)) ? $middle = ucfirst(substr($model->middle_name, 0,1)).'.' : $middle = '';
?>
<div class="ui tab segment active" data-tab="first">
	<?= UiTable::widget([
	    'model' => $model,
	    'options' => ['class' => 'ui fixed very basic table'],
	    'attributes' => [
	        'id',
	    	[
	    		'attribute' => 'status',
	    		'value' => $model->getStatus($model->status)
	    	],
	        'first_name',
	        'middle_name',
	        'last_name',
	        'nickname',
	        [
	        	'attribute' => 'gender',
	        	'value' => $model->getGender($model->gender)
	        ],
	        [
	        	'attribute' => 'grade_level_id',
	        	'value' => $model->getGradeLevelId($model->grade_level_id)
	        ],
	        [
	        	'attribute' => 'birth_date',
	        	'value' => $model->getBirthdate($model->birth_date)
	        ],
	        'address',
	        'zip_code',
	        'religion',
	        'citizenship',
	        'phone',
	        'mobile'
	    ],
	])?></div>
<div class="ui tab segment hidden" data-tab="second">
	<?= UiTable::widget([
	    'model' => $model,
	    'options' => ['class' => 'ui fixed very basic table'],
	    'attributes' => [
	    	'fathers_name',
	    	'fathers_religion',
	    	'fathers_citizenship',
	    	'fathers_occupation',
	    	'fathers_employer',
	    	'fathers_email',
	    	'fathers_mobile',
	    	'fathers_mobile',

	    	'mothers_name',
	    	'mothers_religion',
	    	'mothers_citizenship',
	    	'mothers_occupation',
	    	'mothers_employer',
	    	'mothers_email',
	    	'mothers_mobile',
	    	'mothers_mobile',

	    	[
	    		'attribute' => 'parents_are',
	    		'value' => $model->getParentsAre($model->parents_are)
	    	],
	    	[
	    		'attribute' => 'father_is',
	    		'value' => $model->getFatherIs($model->father_is)
	    	],
	    	[
	    		'attribute' => 'mother_is',
	    		'value' => $model->getMotherIs($model->mother_is)
	    	],
	    ],
	])?></div>
<div class="ui tab segment hidden" data-tab="third">
	<div class="ui two column">
		<div class="six wide stackable column">
			<div class="ui items">
				<div class="item">
					<div class="ui small rounded image">
						<img src="<?= $g ?>" style="background: #e9eaed;">
					</div>
					<div class="content">
						<?= UiTable::widget([
								'model' => $model,
								'options' => ['class' => 'ui fixed very basic table'],
								'attributes' => [
									'guardians_name',
									'guardians_relation_to_student',
									'guardians_address',
									'guardians_occupation',
									'guardians_employer',
									'guardians_phone',
									'guardians_mobile',
								],
							]);
						?>
					</div>
				</div>
			</div>
		</div>
	</div></div>
<div class="ui tab segment hidden" data-tab="fourth">
	<?= UiTable::widget([
	    'model' => $model,
	    'options' => ['class' => 'ui fixed very basic table'],
	    'attributes' => [
	    	'previous_school_name',
	        [
	        	'attribute' => 'previous_school_grade_level',
	        	'value' => $model->getGradeLevelId($model->grade_level_id)
	        ],
	    	'previous_school_address',
	    	'previous_school_description',
	    	'previous_school_teacher_in_charge',
	    	'previous_school_principal',
	    	'previous_school_from_school_year',
	    	'previous_school_to_school_year',
	    	'previous_school_phone',
	    	'previous_school_mobile',
	    ],
	])?></div>
<div class="ui tab segment hidden" data-tab="fifth">
	<?= UiTable::widget([
	    'model' => $model,
	    'options' => ['class' => 'ui fixed very basic table'],
	    'attributes' => [
            [
            	'attribute' => 'student_has_sibling_enrolled',
            	'value' => $model->getHasSiblingEnrolled($model->student_has_sibling_enrolled)
            ],
            [
            	'attribute' => 'student_photo',
            	'value' => $model->getSubmitted($model->student_photo)
            ],
            [
            	'attribute' => 'guardians_photo',
            	'value' => $model->getSubmitted($model->guardians_photo)
            ],
            [
            	'attribute' => 'report_card',
            	'value' => $model->getSubmitted($model->report_card)
            ],
            [
            	'attribute' => 'birth_certificate',
            	'value' => $model->getSubmitted($model->birth_certificate)
            ],
            [
            	'attribute' => 'good_moral',
            	'value' => $model->getSubmitted($model->good_moral)
            ],
	    ],
	])?></div>
<?php
$this->registerJs("
    $('#student-info-menu .ui.menu')
    .on('click', '.item', function() {
        $(this).addClass('active').siblings('.item').removeClass('active');
        var sel = $(this).attr('data-tab');
        var tab = $('.ui.tab.segment');
        var t = $('#student-info-menu').find('[data-tab=\"' + sel + '\"]');
        $(t).addClass('active').removeClass('hidden').siblings('.ui.tab.segment').removeClass('active').addClass('hidden');
    });
");?>