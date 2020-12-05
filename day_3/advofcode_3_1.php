<?php

$file = 'adv_day_3.txt';

echo '<pre>';
var_dump(get_houses_nr($file));
echo '</pre>';

function get_houses_nr($file)
{
    $str = file_get_contents($file);
    $n = strlen($str);


    $i = 0;
    $j = 0;
    $a = array();

    $a[0][0] = 1;
    $count = 1;

    for ($k = 0; $k < $n; $k++) {
        $char = $str{$k};

        switch ($char) {
            case '>':
                $i++;
                break;

            case '<':
                $i--;
                break;

            case '^':
                $j++;
                break;

            case 'v':
                $j--;
                break;
        }

        if (!isset($a[$i][$j])) {
            $count++;
            $a[$i][$j] = 0;
        }

        $a[$i][$j] += 1;

    }

    return $count;
}