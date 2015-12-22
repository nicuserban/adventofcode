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
		$enc_str=addslashes($str);
		$enc_str='"' . $enc_str .'"';
		$current_nr=strlen($enc_str)-strlen($str);
		$total+=$current_nr;
	}
	
	return $total;
}

