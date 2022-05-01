<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class ContatoEnum extends Enum {

    const TIPO_TELEFONE = 1;
    const _TIPO_TELEFONE = 'Telefone';
    const TIPO_EMAIL = 2;
    const _TIPO_EMAIL = 'E-mail';

    public static function getDescription($value): string {
        switch ($value) {
            case self::TIPO_TELEFONE:
                return self::_TIPO_TELEFONE;
            case self::TIPO_EMAIL:
                return self::_TIPO_EMAIL;
            default:
                return self::getKey($value);
        }
    }
    
    public static function getListaTipo() {
        return [
            self::TIPO_TELEFONE => self::_TIPO_TELEFONE,
            self::TIPO_EMAIL => self::_TIPO_EMAIL
        ];
    }
}
