<?php
	require('http_functions.php');
	require('simple_html_dom.php');

	$location_ids = $_GET["location_ids"];

	define("API_KEY", "f523e9b5ab873acee5348d4565b18acf");

	mysql_connect("localhost", "root", "") or die(mysql_error());;
	mysql_select_db("gowalla") or die(mysql_error());;

	$SP = explode(",", $location_ids);

//	$url = "http://localhost:8081/azure/Bookblock/fetch_location/getLatLng.php?location_id=" . $location_id;

	$url = "fetch_location/getImage.php?location_id=" . $SP[0];

	$pic1 = httpGet($url);

	$url = "fetch_location/getImage.php?location_id=" . $SP[1];

	$pic2 = httpGet($url);

	$url = "fetch_location/getImage.php?location_id=" . $SP[2];

	$pic3 = httpGet($url);

	echo $pic1 . "," . $pic2 . "," . $pic3;

?>