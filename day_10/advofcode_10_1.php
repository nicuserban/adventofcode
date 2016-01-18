<?php
$input_str='1321131112';
$turns_nr=40;

echo '<pre>';
var_dump(look_and_say($input_str, $turns_nr));
echo '</pre>';

function look_and_say($str, $turns_nr)
{
	for($i=0; $i<$turns_nr; $i++)
	{
		$length=strlen($str);
		$new_str='';
		$current_char_nr=0;
		$current_char='';
		for($j=0;$j<$length;$j++)
		{
			$char=$str[$j];
			if(empty($current_char) || $current_char!=$char)
			{
				if(!empty($current_char) && !empty($current_char_nr))
					$new_str.=$current_char_nr . $current_char;
				$current_char=$char;
				$current_char_nr=0;
			}
			$current_char_nr++;
			$chars[$char]=true;
		}
		
		$new_str.=$current_char_nr . $current_char;
		$str=$new_str;
		
	}
	return strlen($str);
}