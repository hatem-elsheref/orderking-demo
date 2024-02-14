<?php

namespace App\Enums;

enum RoleType :int
{
    case ADMIN = 1;
    case STORE = 2;
    case CUSTOMER = 3;
}
