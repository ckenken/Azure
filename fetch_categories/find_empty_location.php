<?php


require('http_functions.php');
require('category.php');

mysql_connect("adsl.cloudapp.net", "ckenken", "Radsl2014") or die(mysql_error());;
mysql_select_db("gowalla") or die(mysql_error());;

$query = "select location_id, latitude, longitude, count(distinct location_id) from gowalla_data_d20 group by location_id";

$kkman = mysql_query($query);

$i = 0;
//0=location_id, 1=lat, 2=long, 3=fake int
while(($fr = mysql_fetch_row($kkman))) { 

	$query = "select location_id from gowalla_data_d20_cate where location_id=" . $fr[0];

	$test = mysql_query($query);

	if(empty($test)) {
		echo $fr[0] . "<br>";
	}
}


?>