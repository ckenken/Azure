<html>
<head>
<meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
</head>
<body>

<?php

mysql_connect("localhost:8889", "root", "root") or die(mysql_error());;

mysql_select_db("gowalla") or die(mysql_error());;

//$query = "drop table missing_cate_d20";

$query = "create table gowalla_data_d20_cate(location_id bigint primary key, categories text, distances text)";

//$query = "select * from gowalla_data_d20_cate where location_id=949702";

// $query =  "create table progress2(id bigint primary key, percent double, amount bigint)";

//$query = "create table missing_cate_d20(location_id bigint primary key, latitude double, longitude double)";

// $query = "create table gowalla_data_d20_image(location_id bigint primary key, url varchar(255), file varchar(255))";

//$query = "select * from gowalla_data_d20_cate where location_id=9181";

//$i = 1;

// $query = "insert into progress2 values(0,0,0)";

//$query = "update progress2 set amount =0, percent =0 where id = 0";

$kkman = mysql_query($query);

var_dump($kkman);

// $num = mysql_num_rows($kkman);
/*
if($num == 0) {
	echo "12345";
}
else 
{
	echo "43439589";
}
*/

/*
while($a = mysql_fetch_row($kkman)) {

	var_dump($a);// 353485 

//	echo strlen($a[1]);

	echo "<br>";
}
*/

?>
</body>
</html>