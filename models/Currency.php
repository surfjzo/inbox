<?php

namespace app\models;


class Currency
{
    private static $USD = 1.1993;
    private static $EUR = 1;
    private static $BRL = 3.9729;

    private static $USD_TEXT = 'USD';
    private static $EUR_TEXT = 'EUR';
    private static $BRL_TEXT = 'BRL';

    public static function getCurrency()
    {
        if (\Yii::$app->user->isGuest) {
            return self::getDefaultCurrency();
        }
        $user = Users::findOne(['id' => \Yii::$app->user->id]);
        switch ($user->currency) {
            case 'USD':
                return self::$USD;
            case 'EUR':
                return self::$EUR;
            case 'BRL':
                return self::$BRL;
        }
    }
    public static function getDefaultCurrency()
    {
        return self::$EUR;
    }
    public static function getDefaultCurrencyText()
    {
        return self::$EUR_TEXT;
    }
}