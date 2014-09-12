<?php
	require('http_functions.php');
	require('simple_html_dom.php');

	$lat = "";
	$lng = "";
	$name = "";

	$lat = $_GET["lat"];
	$lng = $_GET["lng"];
	$name = $_GET["name"];

	define("API_KEY", "f523e9b5ab873acee5348d4565b18acf");

	mysql_connect("localhost:8889", "root", "root") or die(mysql_error());;
	mysql_select_db("gowalla") or die(mysql_error());;

	if(strlen($lat) == 0) {
		$url = "http://flickr.com/services/rest/?method=flickr.photos.search&api_key=" . API_KEY . "&perpage=5&page=10&text=" . $name;
	}
	else if (strlen($lat) > 0 && strlen($name) == 0) {
		$url = "http://flickr.com/services/rest/?method=flickr.photos.search&api_key=" . API_KEY . "&lat=" . $lat . "&lon=" . $lng . "&perpage=5&page=" . "10";
	}
	else {
		$url = "http://flickr.com/services/rest/?method=flickr.photos.search&api_key=" . API_KEY . "&lat=" . $lat . "&lon=" . $lng . "&perpage=5&page=10&text=" . $name;
	}

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

		break;   // 暫時只取一張圖
	}
?>