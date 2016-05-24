<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "global_settings".
 *
 * @property integer $data_access_request
 * @property integer $maintenance_mode
 */
class GlobalSettings extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'global_settings';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['data_access_request', 'maintenance_mode'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'data_access_request' => 'Data Access Request',
            'maintenance_mode' => 'Maintenance Mode',
        ];
    }
}
