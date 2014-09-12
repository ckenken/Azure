<?php

require('http_functions.php');

mysql_connect("localhost:8899", "root", "root") or die(mysql_error());;
mysql_select_db("gowalla") or die(mysql_error());;

$url = "https://api.foursquare.com/v2/venues/categories?client_id=BXTCY4HGTLWINDPRLFXCOWRUEDAJC12ZHEGDTGX4A5DX413K&client_secret=X20DAZW4CXKKC2V1O4QXYYHEQ1T5BMIBHUYD5ZJOVUKGFD3V&v=20140728";

$str = httpGet($url);

$json = json_decode($str);

foreach ($json->response->categories as $index => $content) {

	echo $index . ": " . $content->name . "<br>";

	$parent = $content->name;

	insert($parent, $parent);

	foreach ($content->categories as $index2 => $content2) {
		
		insert($content2->name, $parent);
		echo "OOOO: " . $content2->name . "<br>";
		if (count($content2->categories) > 0) {
			foreach ($content2->categories as $index3 => $content3) {
				insert($content3->name, $parent);
				echo "OOOOXXXX: " . $content3->name . "<br>";
		
			}
		}
	}		

}


function insert($name, $parent)
{
	$query = "insert into categories values(NULL,'" . $name . "','"  . $parent . "')";

	return mysql_query($query);
}



?>