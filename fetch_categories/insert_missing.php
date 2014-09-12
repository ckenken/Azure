<?php

require('http_functions.php');
require('category.php');

mysql_connect("adsl.cloudapp.net", "ckenken", "Radsl2014") or die(mysql_error());;
mysql_select_db("gowalla") or die(mysql_error());;

$query = "select location_id, latitude, longitude, from missing_cate_d20";

$kkman = mysql_query($query);

$i = 0;
//0=location_id, 1=lat, 2=long, 3=fake int
while(($fr = mysql_fetch_row($kkman))) { 

//	echo $fr[0] . ": " . $fr[1] . ", " . $fr[2] ."<br>";

	$url = "https://api.foursquare.com/v2/venues/search?limit=30&ll=" . $fr[1] . "," . $fr[2] . "&client_id=BXTCY4HGTLWINDPRLFXCOWRUEDAJC12ZHEGDTGX4A5DX413K&client_secret=X20DAZW4CXKKC2V1O4QXYYHEQ1T5BMIBHUYD5ZJOVUKGFD3V&v=20140728";

	$str = httpGet($url);

//	echo $str . "<br>";

	$json = json_decode($str);

// 	var_dump($json);

//	echo "<br><br>===============<br><br>";

//	echo "123: " . $json->response->venues[0]->categories[0]->pluralName . "<br>";

	$cates = array();

	$first = 1;
	foreach($json->response->venues as $fake => $v) {

		if (strcmp($v->categories[0]->pluralName, "") == 0) {

			echo $fr[0] . "<br>";
			continue;
		}
		else 
			continue;
			
		$temp = new category;

		$temp->pName = $v->categories[0]->pluralName;
		$temp->dist = $v->location->distance;

		array_push($cates, $temp);

//		echo $v->categories[0]->pluralName . " " . $v->location->distance ."<br>";
//		echo "<br>";

	}

	usort($cates, "cmpCate");

	$cateStr = "";
	$distStr = "";

	$first = 1;
	foreach($cates as $t) {
	//	echo $t->pName . "<br>";
		if($first == 1) {
			$first = 0;
			$cateStr .= $t->pName;
			$distStr .= $t->dist;		
		}
		else {
			$cateStr .= "," . $t->pName;
			$distStr .= "," . $t->dist;		
		} 
	}

//	echo $cateStr . "<br>";
//	echo $distStr . "<br>";

	$query = "insert into gowalla_data_d20_cate values(" . $fr[0] . ",'" . $cateStr . "','" . $distStr . "')";
	$r = mysql_query($query);

	//break;

	$percent = ((double)($i+1)/11232.0) * 100.0;
	$query = "update progress set percent =" . $percent . ",amount =" . strval($i+1) . " where id=0";
	mysql_query($query);

	$i++;
}

// echo $i; // 88182 

echo "Done.";

?>

