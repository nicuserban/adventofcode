<?php
$file = 'adv_day_9.txt';


echo '<pre>';
var_dump(get_shortest_distance($file));
echo '</pre>';

function get_shortest_distance($file)
{
    $total = 0;
    $handle = fopen($file, 'r');
    $distances = array();
    $all_citites = array();
    while ($str = fgets($handle)) {
        $str = trim($str);
        $dist_array = explode('=', $str);
        if (count($dist_array) == 2) {
            $cities = trim($dist_array[0]);
            $dist = intval($dist_array[1]);
            $cities_arr = explode('to', $cities);

            if (count($cities_arr) == 2) {
                $city_1 = trim($cities_arr[0]);
                $city_2 = trim($cities_arr[1]);
                if (!isset($distances[$city_1])) {
                    $distances[$city_1] = array();
                    $all_cities[] = $city_1;
                }

                if (!isset($distances[$city_2])) {
                    $distances[$city_2] = array();
                    $all_cities[] = $city_2;
                }

                $distances[$city_1][$city_2] = $dist;
                $distances[$city_2][$city_1] = $dist;
            }

        }

    }

    return get_subdistance($all_cities, '', $distances, 0);
}

function get_subdistance($remaining_cities, $starting_city, $distances, $current_distance)
{
    $computed_distances = array();

    foreach ($remaining_cities as $key => $next_city) {
        $__cities = $remaining_cities;
        unset($__cities[$key]);
        if (!empty($starting_city))
            $this_distance = $current_distance + $distances[$starting_city][$next_city];
        else
            $this_distance = $current_distance;

        if (empty($__cities))
            return $this_distance;

        $computed_distances[] = get_subdistance($__cities, $next_city, $distances, $this_distance);
    }

    return min($computed_distances);
}

