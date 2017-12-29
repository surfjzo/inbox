<?php

namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $name
 * @property string $username
 * @property string $password
 * @property string $authKey
 * @property string $currency
 */
class Users extends ActiveRecord implements IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'username', 'password', 'authKey', 'currency'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'username' => 'Username',
            'password' => 'Password',
            'authKey' => 'Auth Key',
            'currency' => 'Currency'
        ];
    }

    public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('Method not implemented',911);
    }

    public function getId()
    {
        return $this->id;
    }

    public static function getCurrency()
    {
        if (Yii::$app->user->isGuest) {
            return Currency::getDefaultCurrencyText();
        } else {
            return self::findOne(['id' => Yii::$app->user->id])->currency;
        }
    }

    public function getAuthKey()
    {
        return $this->authKey;
    }

    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    public static function findByUsername($username) {
        return self::findOne(['username' => $username]);
    }

    public function validatePassword($password) {
        return $this->password === $password;
    }
}
