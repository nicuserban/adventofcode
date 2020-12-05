<?php

$str = 'iwrupvqb';

echo '<pre>';
var_dump(get_lowest_nr($str));
echo '</pre>';

function get_lowest_nr($str)
{

    $i = 1;

    while ($i <= PHP_INT_MAX) {
        $current_str = $str . $i;
        $current_hash = md5($current_str);

        if (substr($current_hash, 0, 6) === '000000')
            return $i;

        $i++;
    }


    return null;
}