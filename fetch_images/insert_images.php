<meta http-equiv="Content-Type" content="text/html" charset="utf-8" />

<?php

require('http_functions.php');
require('simple_html_dom.php');

define("API_KEY", "f523e9b5ab873acee5348d4565b18acf");

mysql_connect("adsl.cloudapp.net", "ckenken", "Radsl2014") or die(mysql_error());;
mysql_select_db("gowalla") or die(mysql_error());;


$query = "select location_id from gowalla_data_d20_cate";

$kkman = mysql_query($query);

$i = 0;

// 0 = locaiton_id
while($row = mysql_fetch_row($kkman)) {
	$query = "select latitude, longitude from gowalla_data_d20 where location_id=" . $row[0];

	$loc = mysql_query($query);

	// 0 == lat, 1 == long
	$fr = mysql_fetch_row($loc);

	$url = "http://flickr.com/services/rest/?method=flickr.photos.search&api_key=" . API_KEY . "&lat=" . $fr[0] . "&lon=" . $fr[1] . "&perpage=5&page=" . "10";

//	echo $url . "<br>";

	$xml = httpGet($url);

//	var_dump($xml);

//	echo $xml;

	$sxml = simplexml_load_string($xml);

//	var_dump($sxml);

	foreach($sxml->photos[0]->photo as $fake => $p) {

//		echo $fake . ": ";

//		echo "id: " . $p->attributes()['id'] . "<br>";

		$id = $p->attributes()['id'];

		$url = "http://flickr.com/services/rest/?method=flickr.photos.getinfo&api_key=" . API_KEY . "&photo_id=" . $id;

		$infoXML = httpGet($url);

		$sInfoXML = simplexml_load_string($infoXML);

		$reURL = $sInfoXML->photo->urls->url[0];

//		echo $reURL . "<br>";

		$dom = file_get_html($reURL);

		$metas = $dom->find('meta');

		$jpg = "";

		foreach($metas as $v) {

			if(strcmp($v->property, "og:image") == 0) {
				$jpg = $v->content;
				break;
			} 
		}

		echo $jpg;

		$query = "insert into gowalla_data_d20_image values(" . $row[0] . ",'" . $jpg . "','')"; 
		$r = mysql_query($query);

		break;   // 暫時只取一張圖
	}


	$percent = ((double)($i+1)/88182.0) * 100.0;
	$query = "update progress2 set percent =" . $percent . ",amount =" . strval($i+1) . " where id=0";
	mysql_query($query);

	$i++;
	//break;
}
?>