<?php

$file = 'adv_day_2.txt';

echo '<pre>';
var_dump(get_total($file));
echo '</pre>';

function get_total($file)
{
    $total = 0;
    $handle = fopen($file, 'r');
    while ($gift = fgets($handle)) {
        $square = explode('x', $gift);
        $l = intval($square[0]);
        $w = intval($square[1]);
        $h = intval($square[2]);
        $s1 = $l * $w;
        $s2 = $l * $h;
        $s3 = $w * $h;
        $min = min($s1, $s2, $s3);
        $surface = 2 * ($s1 + $s2 + $s3) + $min;
        $total += $surface;
    }

    return $total;
}