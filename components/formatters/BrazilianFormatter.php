<?php

namespace app\components\formatters;

use yii\i18n\Formatter;

class BrazilianFormatter extends Formatter
{
    public static function asStatus($value)
    {
        return $value ? 'Ativo' : 'Inativo';
    }

    public static function asStatusHighlighted($value)
    {
        return $value ? '<span class="text-info"><strong>Ativo</strong></span>' :
        '<span class="text-warning"><strong>Inativo</strong></span>';
    }

    public static function asHighlight($value)
    {
        return $value ? 'Yes' : 'No';
    }

    public static function asWrap($value)
    {
        return wordwrap($value, 50, '<br>');
    }
}
