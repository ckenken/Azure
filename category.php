<?php

class category
{
	public $pName;
	public $dist;
}

function cmpCate($a, $b) 
	{
		if($a->dist > $b->dist)	{
			return 1;	
		}
		else if ($a->dist < $b->dist){
			return -1;
		}
		else {
			return 0;
		}
	}


?>