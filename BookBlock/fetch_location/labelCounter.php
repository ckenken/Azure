<?php

require('http_functions.php');

mysql_connect("localhost", "root", "") or die(mysql_error());;
mysql_select_db("gowalla") or die(mysql_error());;

foreach ($_POST as $index => $t) {
	$query = "select categories from gowalla_data_d20_cate where location_id=" . $t;

	$result = mysql_query($query);

	$fr = mysql_fetch_row($result);

	$SP = explode(",", $fr[0]); //SP[0] 是 最前面的一個 cate

	$query = "select parent from categories where name =" . $SP[0];

	$result2 = mysql_query($query);

	$fr2 = mysql_fetch_row($result2);

	$SP2 = explode(" ", $fr2[0]);

	

}




?>