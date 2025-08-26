<?php

declare(strict_types=1);

namespace App\Enums;

enum DocumentType: string
{
    case Invoice = 'invoice';
    case Proforma = 'proforma';
    case Receipt = 'receipt';
}
