<?php 

$file='adv_day_2.txt';

echo '<pre>';
var_dump(get_total($file));
echo '</pre>';

function get_total($file)
{
	$total=0;
	$handle=fopen($file, 'r');
	while($gift=fgets($handle))
	{
		$square=explode('x', $gift);
		sort($square, SORT_NUMERIC);
		$d1=$square[0];
		$d2=$square[1];
		$d3=$square[2];
		
		$this_l=2*($d1+$d2);
		$this_l+=$d1*$d2*$d3;
		
		$total+=$this_l;
	}
	
	return $total;
}