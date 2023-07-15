<?php 

function formatNumber($number)
{
    $units = ['', 'k', 'M', 'B', 'T'];

    $unit = '';
    $index = 0;

    while ($number >= 1000 && $index < count($units) - 1) {
        $number /= 1000;
        $unit = $units[++$index];
    }

    return number_format($number, ($number >= 10 || $number == intval($number)) ? 0 : 1) . $unit;
}
