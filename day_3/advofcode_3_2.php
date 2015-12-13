<?php 

$file='adv_day_3.txt';

echo '<pre>';
var_dump(get_houses_nr($file));
echo '</pre>';

function get_houses_nr($file)
{
	$str=file_get_contents($file);
	$n=strlen($str);
	
	
	$i=0;
	$j=0;
	
	$p=0;
	$q=0;
	$a=array();
	
	$a[0][0]=2;
	$count=1;
	
	for($k=0; $k<$n; $k++)
	{
		$char=$str{$k};
		if($k%2==1)
		{
			$h_var='i';
			$v_var='j';
		}
		else
		{
			$h_var='p';
			$v_var='q';
		}
			
		
		switch($char)
		{
			case '>':
				$$h_var++;
			break;
			
			case '<':
				$$h_var--;
			break;
			
			case '^':
				$$v_var++;
			break;
			
			case 'v':
				$$v_var--;
			break;
		}
		
		if(!isset($a[$$h_var][$$v_var]))
		{
			$count++;
			$a[$$h_var][$$v_var]=0;
		}
		
		$a[$$h_var][$$v_var]+=1;
		
	}
	
	return $count;
}