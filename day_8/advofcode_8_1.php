<?php 
$file='adv_day_8.txt';


echo '<pre>';
var_dump(get_total($file));
echo '</pre>';

function get_total($file)
{
	$total=0;
	$handle=fopen($file, 'r');
	while($str=fgets($handle))
	{
		$str=trim($str);
		eval('$tmp_var=' . $str .';');
		$current_nr=strlen($str)-strlen($tmp_var);
		$total+=$current_nr;
	}
	
	return $total;
}

