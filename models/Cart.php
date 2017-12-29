<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cart".
 *
 * @property int $id
 * @property int $userId
 * @property int $productId
 *
 * @property Products $product
 * @property Users $user
 */
class Cart extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cart';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userId', 'productId'], 'integer'],
            [['productId'], 'exist', 'skipOnError' => true, 'targetClass' => Products::className(), 'targetAttribute' => ['productId' => 'id']],
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
            'productId' => 'Product ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Products::className(), ['id' => 'productId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'userId']);
    }

    public static function isEmpty()
    {
        if (Yii::$app->user->isGuest) {
            return true;
        } else {
            $cart = CartSearch::find()->where(['userId' => Yii::$app->user->id])->asArray()->all();
            if ($cart > 0) {
                return false;
            } else {
                return true;
            }
        }
    }
}
