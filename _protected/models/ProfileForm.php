<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $email
 * @property string $password_hash
 * @property integer $status
 * @property string $auth_key
 * @property string $password_reset_token
 * @property string $account_activation_token
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $first_name
 * @property string $middle_name
 * @property string $last_name
 * @property string $gender
 * @property string $birth_date
 * @property string $address
 * @property integer $phone
 * @property integer $mobile
 * @property string $notes
 */
class ProfileForm extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'email', 'first_name', 'middle_name', 'last_name', 'gender', 'address'], 'required'],
            [['phone', 'mobile', 'gender'], 'integer'],
            [['birth_date'], 'safe'],
            [['username', 'email', 'address', 'notes'], 'string', 'max' => 255],
            [['first_name', 'middle_name', 'last_name'], 'string', 'max' => 45],
            [['profile_image'], 'string', 'max' => 255],
            [['username'], 'unique'],
            [['email'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
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
        ];
    }

    public function formatDate($date){
        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        if(strpos($date, '/') !== false){

            $m = trim(substr($date, 0, 2));
            $d = trim(substr($date, 3, 2));
            $Y = substr($date, 6, 4);
            $this->birth_date = $Y . '-' . $m . '-' . $d;
            $date = $this->birth_date;

            return $date;
        }

        if(strpos($date, ',') !== false){
            if(strlen($date) === 12){
                $m = trim(substr($date, 0, 3));

                for($i = 0; $i <= 11; $i++){
                    if($months[$i] === $m){
                        $m = $i+=1;
                        $d = trim(substr($date, 4, 2));
                        $Y = substr($date, 8, 4);
                        $this->birth_date = $this->birth_date = $Y . '-' . $m . '-' . $d;
                        $date = $this->birth_date;

                        return $date;
                    }
                }
            } else {
                $m = trim(substr($date, 0, 3));
                
                for($i = 0; $i <= 11; $i++){
                    if($months[$i] === $m){
                        $m = $i+=1;
                        $d = substr($date, 4, 1);
                        $Y = substr($date, 7, 4);
                        $this->birth_date = $this->birth_date = $Y . '-' . $m . '-' . $d;
                        $date = $this->birth_date;

                        return $date;
                    }
                }
            }
        }

    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if($this->isNewRecord){
                $this->formatDate($this->birth_date);
                return true;
            } else {
                $this->formatDate($this->birth_date);
                return true;
            }
        } else {
            return false;
        }
    }
}
