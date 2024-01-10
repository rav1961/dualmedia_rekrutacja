<?php

namespace App\Enum;

enum OrderStatus: string
{
    case NEW = 'nowe';
    case CANCELED = 'anulowane';
    case COMPLETED = 'kompletne';
}
