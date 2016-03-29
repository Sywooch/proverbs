<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sibling_discount".
 *
 * @property integer $id
 * @property integer $percentage_value
 */
class SiblingDiscount extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sibling_discount';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['percentage_value'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'percentage_value' => 'Percentage Value',
        ];
    }
}
