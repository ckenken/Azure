<html>
<head>
<meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
</head>

<?php

mysql_connect("adsl.cloudapp.net", "ckenken", "Radsl2014") or die(mysql_error());;

mysql_select_db("gowalla") or die(mysql_error());;

//$query = "drop table progress";

//$query = "create table gowalla_data_d20_cate(location_id bigint primary key, categories text, distances text)";

// $query = "create table progress(id int primary key, percent double, amount int)";

$query = "select Count(*) from gowalla_data_d20_cate";

// $query = "insert into progress values(0, 0.0, 0)";

//$i = 1;

//$query = "update progress set amount =0, percent =0 where id = 0";

$kkman = mysql_query($query);

 $a = mysql_fetch_row($kkman);

var_dump($a); // 353485 

//var_dump($kkman);


?>

</html>