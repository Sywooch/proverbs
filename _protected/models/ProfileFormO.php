<?php
namespace app\models;

use yii\base\Model;
use Yii;

/**
 * Model representing  Signup Form.
 */
class ProfileForm extends Model
{
    public $first_name;
    public $last_name;
    public $gender;
    public $address;
    public $phone;
    public $mobile;
    public $notes;

    /**
     * Returns the validation rules for attributes.
     *
     * @return array
     */
    public function rules()
    {
        return [
            ['first_name', 'middle_name', 'last_name', 'gender', 'birth_date', 'address' 'required'],

            ['first_name', 'string', 'min' => 2, 'max' => 45],
            ['middle_name', 'string', 'max' => 45],
            ['last_name', 'string', 'max' => 45],
            ['gender', 'string', 'min' => 1, 'max' => 7],
            ['address', 'string', 'max' => 255],
            ['phone', 'integer', 'max' => 11],
            ['mobile', 'integer', 'max' => 11],
            ['notes', 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'first_name' => Yii::t('app', 'First Name'),
            'middle_name' => Yii::t('app', 'Middle'),
            'last_name' => Yii::t('app', 'Surname'),
            'gender' => Yii::t('app', 'Gender'),
            'birth_date' => Yii::t('app', 'Birthday'),
            'address' => Yii::t('app', 'Address'),
            'phone' => Yii::t('app', 'Phone'),
            'mobile' => Yii::t('app', 'Mobile'),
            'notes' => Yii::t('app', 'Notes'),
        ];
    }
}
