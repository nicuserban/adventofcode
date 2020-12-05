<?php

$file = 'adv_day_6.txt';

echo '<pre>';
var_dump(follow_instructions($file));
echo '</pre>';

function follow_instructions($file)
{
    $arr = array();

    for ($i = 0; $i < 1000; $i++) {
        for ($j = 0; $j < 1000; $j++)
            $a[$i][$j] = 0;
    }

    $handle = fopen($file, 'r');
    while ($str = fgets($handle)) {
        $action = 0;
        $action_str = '';
        if (substr_count($str, 'turn on')) {
            $action = 1;
            $action_str = 'turn on';
        } elseif (substr_count($str, 'turn off')) {
            $action = 2;
            $action_str = 'turn off';
        } elseif (substr_count($str, 'toggle')) {
            $action = 3;
            $action_str = 'toggle';
        }

        if ($action) {
            $str = str_replace($action_str, '', $str);
            $str_arr = explode('through', $str);
            if (count($str_arr) == 2) {
                $start_coord = trim($str_arr[0]);
                $end_coord = trim($str_arr[1]);
                $start_coord_arr = explode(',', $start_coord);
                if (count($start_coord_arr) == 2) {
                    $i = intval($start_coord_arr[0]);
                    $k = intval($start_coord_arr[1]);
                    $end_coord_arr = explode(',', $end_coord);
                    if (count($end_coord_arr) == 2) {
                        $j = intval($end_coord_arr[0]);
                        $l = intval($end_coord_arr[1]);
                        for ($p = $i; $p <= $j; $p++) {
                            for ($q = $k; $q <= $l; $q++) {
                                $current = $a[$p][$q];
                                if ($action == 1)
                                    $current++;
                                elseif ($action == 2) {

                                    $current--;
                                    if ($current < 0)
                                        $current = 0;
                                } elseif ($action == 3)
                                    $current += 2;

                                $a[$p][$q] = $current;
                            }
                        }
                    }
                }
            }
        }
    }

    $lit_val = 0;
    for ($i = 0; $i < 1000; $i++) {
        for ($j = 0; $j < 1000; $j++)
            $lit_val += $a[$i][$j];
    }

    return $lit_val;
}