<?php

namespace App\Enums;

enum RoleStatus: string
{
    case ADMIN = 'admin';
    case User = 'user';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
