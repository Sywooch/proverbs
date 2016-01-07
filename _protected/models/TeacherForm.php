<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use app\rbac\models\AuthAssignment;
use app\rbac\models\AuthItem;

class TeacherForm extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'user';
    }

    public function rules()
    {
        return [
            [['username', 'email', 'password_hash', 'status', 'auth_key', 'first_name', 'middle_name', 'last_name', 'gender', 'address'], 'required'],
            [['status', 'created_at', 'updated_at', 'phone', 'mobile', 'gender'], 'integer'],
            [['birth_date'], 'safe'],
            [['username', 'email', 'password_hash', 'password_reset_token', 'account_activation_token', 'address', 'notes', 'profile_image'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['first_name', 'middle_name', 'last_name'], 'string', 'max' => 45],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique']
        ];
    }


    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'email' => 'Email',
            'password_hash' => 'Password Hash',
            'status' => 'Status',
            'auth_key' => 'Auth Key',
            'password_reset_token' => 'Password Reset Token',
            'account_activation_token' => 'Account Activation Token',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'first_name' => 'First Name',
            'middle_name' => 'Middle Name',
            'last_name' => 'Last Name',
            'gender' => 'Gender',
            'birth_date' => 'Birth Date',
            'address' => 'Address',
            'phone' => 'Phone',
            'mobile' => 'Mobile',
            'notes' => 'Notes',
            'profile_image' => 'Profile Image',
        ];
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
        ];
    }

    public static function getRolesList()
    {
        $roles = [];

        foreach (AuthItem::getRoles() as $item_name) 
        {
            $roles[$item_name->name] = $item_name->name;
        }

        return $roles;
    }

    public static function getTeacherRole()
    {
        foreach (AuthItem::getRoles() as $item_name) 
        {
            if($item_name->name === 'teacher'){
                $role = $item_name->name;
            }
        }

        return $role;
    }
    
    public function getRole()
    {
        // User has_one Role via Role.user_id -> id
        return $this->hasOne(Role::className(), ['user_id' => 'id']);
    }
    public function getRoleName()
    {
        return $this->role->item_name;
    }
}
