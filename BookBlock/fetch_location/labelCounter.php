<?php

require('http_functions.php');

mysql_connect("localhost", "root", "") or die(mysql_error());;
mysql_select_db("gowalla") or die(mysql_error());;

$count = array();

foreach ($_POST as $index => $t) {
	$query = "select categories from gowalla_data_d20_cate where location_id=" . $t;

	$result = mysql_query($query);

	$fr = mysql_fetch_row($result);

	$SP = explode(",", $fr[0]); //SP[0] 是 最前面的一個 cate

	$query = "select parent from categories where name =" . $SP[0];

	$result2 = mysql_query($query);

	$fr2 = mysql_fetch_row($result2);

	$SP2 = explode(" ", $fr2[0]);

	$count[$SP2[0]]++;
}

echo json_encode($count);

/*
foreach($count as $index => $t) {
	echo $index . ": " . $t . "<br>";
}
*/

/*
Arts & Entertainment
College & University
Event
Food
Nightlife Spot
Outdoors & Recreation
Professional & Other Places
Residence
Shop & Service
Travel & Transport
*/

?>