<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "checkout".
 *
 * @property int $id
 * @property int $userId
 * @property double $value
 *
 * @property Users $user
 */
class Checkout extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'checkout';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userId'], 'integer'],
            [['value'], 'number'],
            [['userId'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['userId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'userId' => 'User ID',
            'value' => 'Value',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'userId']);
    }
}
