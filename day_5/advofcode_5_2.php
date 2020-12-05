<?php

$file = 'adv_day_5.txt';

echo '<pre>';
var_dump(get_nice_nr($file));
echo '</pre>';

function get_nice_nr($file)
{
    $nice = 0;
    $handle = fopen($file, 'r');


    while ($str = fgets($handle)) {
        $pair_c = false;
        $third = false;

        $prev_third_char = '';
        $prev_second_char = '';

        $n = strlen($str);
        for ($i = 0; $i < $n; $i++) {
            $char = $str{$i};
            if ($i > 0 && !$pair_c) {
                $pair = substr($str, $i - 1, 2);
                if (substr_count($str, $pair, $i + 1))
                    $pair_c = true;
            }

            if (!$third) {
                if ($i > 1 && $char == $prev_third_char)
                    $third = true;
                elseif ($i == 0)
                    $prev_second_char = $char;
                else {
                    $prev_third_char = $prev_second_char;
                    $prev_second_char = $char;
                }
            }

            if ($pair_c && $third) {
                $nice++;
                break;
            }
        }

    }

    return $nice;
}