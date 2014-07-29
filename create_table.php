<html>
<head>
<meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
</head>

<?php

mysql_connect("adsl.cloudapp.net", "ckenken", "Radsl2014") or die(mysql_error());;

mysql_select_db("gowalla") or die(mysql_error());;

//$query = "drop table gowalla_data_d20_cate";

//$query = "create table gowalla_data_d20_cate(location_id bigint primary key, categories text, distances text)";

//$query = "create table progress(percent double, amount int)";

$query = "select Count(*) from gowalla_data_d20";

$kkman = mysql_query($query);

$a = mysql_fetch_row($kkman);

var_dump($a); // 353485 

//var_dump($kkman);



?>

</html>