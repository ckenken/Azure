

<?php

require('http_functions.php');
require('category.php');

//$gap = $_GET["gap"];

mysql_connect("localhost", "root", "") or die(mysql_error());;
mysql_select_db("gowalla") or die(mysql_error());;

$query = "select location_id, latitude, longitude, count(distinct location_id) from gowalla_data_d20 group by location_id";

$kkman = mysql_query($query);

$i = 0;
//0=location_id, 1=lat, 2=long, 3=fake int
while(($fr = mysql_fetch_row($kkman))) { 
/*	
	if($i < strval($gap)) {
	$i++;
		continue;
	}
*/

//	echo $fr[0] . ": " . $fr[1] . ", " . $fr[2] ."<br>";

	$url = "https://api.foursquare.com/v2/venues/search?limit=30&ll=" . $fr[1] . "," . $fr[2] . "&client_id=BXTCY4HGTLWINDPRLFXCOWRUEDAJC12ZHEGDTGX4A5DX413K&client_secret=X20DAZW4CXKKC2V1O4QXYYHEQ1T5BMIBHUYD5ZJOVUKGFD3V&v=20140728";

//	echo $url;

	//break;

	$str = httpGet($url);

	//echo $str . "<br>";

	$json = json_decode($str);

// 	var_dump($json);

//	echo "<br><br>===============<br><br>";

//	echo "123: " . $json->response->venues[0]->categories[0]->pluralName . "<br>";

	$cates = array();

	$first = 1;
	foreach($json->response->venues as $fake => $v) {

		if (strcmp($v->categories[0]->pluralName, "") == 0) {

	//		echo $fr[0] . "<br>";
			continue;
		}
			
		$temp = new category;

		$temp->pName = $v->categories[0]->pluralName;
		$temp->dist = $v->location->distance;
		$temp->vName = $v->name;

	//	echo $v->name . "<br>";

		array_push($cates, $temp);

//		echo $v->categories[0]->pluralName . " " . $v->location->distance ."<br>";
//		echo "<br>";

	}

//	break;

	usort($cates, "cmpCate");

	$cateStr = "";
	$distStr = "";
	$nameStr = "";

	$first = 1;
	foreach($cates as $t) {
	//	echo $t->pName . "<br>";
		if($first == 1) {
			$first = 0;
			$cateStr .= $t->pName;
			$distStr .= $t->dist;		
			$nameStr .= $t->vName;
		}
		else {
			$cateStr .= "," . $t->pName;
			$distStr .= "," . $t->dist;		
			$nameStr .= "," . $t->vName;
		
		} 
	}

//	echo $cateStr . "<br>";
//	echo $distStr . "<br>";

	$cateStr = mysql_real_escape_string($cateStr);
	$nameStr = mysql_real_escape_string($nameStr);

	$query = "select * from gowalla_data_d20_cate where location_id=" . $fr[0];
	$r = mysql_query($query);

	if(mysql_num_rows($r) == 0) {
		$query = "insert into gowalla_data_d20_cate values(" . $fr[0] . ",'" . $cateStr . "','" . $distStr . "','" . $nameStr . "')";
		$r = mysql_query($query);
	}
	else {
		if(strlen($cateStr) > 10) {
			$query = "update gowalla_data_d20_cate set categories='" . $cateStr . "'," . "distances='" . $distStr . "'," . "name='" . $nameStr . "' where location_id=" . $fr[0];
			$r = mysql_query($query);
		}
	} 

//	echo $query;

//	break;

	$percent = ((double)($i+1)/88182.0) * 100.0;
	$query = "update progress set percent =" . $percent . ",amount =" . strval($i+1) . " where id=0";
	mysql_query($query);

	$i++;
}

// echo $i; // 88182 

echo "Done.";

?>

