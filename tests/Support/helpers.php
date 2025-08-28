<?php

declare(strict_types=1);

namespace Tests\Support;

function makeCsv(array $header, array $rows): string
{
    $path = tempnam(sys_get_temp_dir(), 'csv');
    $tmp = fopen($path, 'w');

    fputcsv($tmp, $header, ';');
    foreach ($rows as $r) {
        fputcsv($tmp, $r, ';');
    }
    fclose($tmp);

    return $path;
}
