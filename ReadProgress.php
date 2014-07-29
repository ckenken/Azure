<?php


mysql_connect("adsl.cloudapp.net", "ckenken", "Radsl2014") or die(mysql_error());;
mysql_select_db("gowalla") or die(mysql_error());;

//$query = "insert into progress values(0.0,0)";

$query = "select * from progress";

$kkman = mysql_query($query);

$row = mysql_fetch_row($kkman);

echo $row[1] . "," . $row[2];

?>