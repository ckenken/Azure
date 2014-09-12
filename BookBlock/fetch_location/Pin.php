<?php

class Pin
{
	public $id;
	public $latitude;
	public $longitude;
	public $location_id;
	public $cluster;	
}


/*

$a = new Pin;

$a->id = 1;
$a->lat = 122;
$a->long = 23;
$a->location_id = null;
$a->cluster = 233435;

$b = new Pin;

$b->id = 2;
$b->lat = 33;
$b->long = 445;
$b->location_id = 66633;
$b->cluster = 22235;

$data = Array();

array_push($data, $a);

array_push($data, $b);

$json = json_encode($data);

echo $json;
*/

?>