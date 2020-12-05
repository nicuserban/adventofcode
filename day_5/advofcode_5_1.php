<?php

$file = 'adv_day_5.txt';

echo '<pre>';
var_dump(get_nice_nr($file));
echo '</pre>';

function get_nice_nr($file)
{
    $nice = 0;
    $handle = fopen($file, 'r');
    $vowels = array('a', 'e', 'i', 'o', 'u');
    $not_nice = array('ab', 'cd', 'pq', 'xy');

    while ($str = fgets($handle)) {
        $vowels_nr = 0;
        $twice = false;
        $prev_char = '';

        $n = strlen($str);
        for ($i = 0; $i < $n; $i++) {
            $current_char = $str{$i};
            if (in_array($current_char, $vowels))
                $vowels_nr++;
            if ($current_char === $prev_char)
                $twice = true;
            $prev_char = $current_char;
        }


        if ($vowels_nr < 3 || !$twice)
            continue;

        foreach ($not_nice as $nn_str) {
            if (substr_count($str, $nn_str))
                continue 2;
        }

        $nice++;

    }

    return $nice;
}