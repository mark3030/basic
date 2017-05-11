<?php
namespace app\helpers;

use yii\i18n\Formatter;
use yii;

class FormatterHelper extends Formatter {
    public static function currencyToFloat($currency) {
        return (float)str_replace(',', '', $currency);
    }
}