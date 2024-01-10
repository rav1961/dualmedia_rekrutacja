<?php

namespace App\Enum;

enum ProductStatus: int
{
    case IN_STOCK = 1;
    case OUT_STOCK = 0;
}
