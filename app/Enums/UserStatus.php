<?php

namespace App\Enums;

enum UserStatus : int
{
    case DISABLE = 0;
    case PENDING = 1;
    case BAN = 2;
    case ENABLE = 3;
}
