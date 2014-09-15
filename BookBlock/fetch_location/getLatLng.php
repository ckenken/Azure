<?php

	$location_id = $_GET["location_id"];

	mysql_connect("localhost", "root", "") or die(mysql_error());;
	mysql_select_db("gowalla") or die(mysql_error());;

	$query = "select latitude, longitude from gowalla_data_d20 where location_id=" . $location_id;

	//echo $query;

	$result = mysql_query($query);

	$fr = mysql_fetch_row($result);
	// 0 = location_id, 1 = cates, 2= distance

	echo $fr[0] . "," . $fr[1];

?>