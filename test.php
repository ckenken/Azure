<html>
<head>
<meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
</head>

<?php

echo "12345<br>";

mysql_connect("adsl.cloudapp.net", "ckenken", "Radsl2014") or die(mysql_error());;

mysql_select_db("gowalla") or die(mysql_error());;

$query = "select user_id from gowalla_data_d20 where location_id=23261";

$kkman = mysql_query($query);

$fr = mysql_fetch_row($kkman);

//var_dump($fr);
?>

<?php

function httpGet($url)
{
    $ch = curl_init();  
 
 	curl_setopt($ch,CURLOPT_HEADER, false); 
 	curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch,CURLOPT_URL, $url);
   // curl_setopt($ch, CURLOPT_ENCODING ,"");
 	
    $output=curl_exec($ch);
 
    curl_close($ch);
    return $output;
}

?>

<?php

$str = httpGet("https://api.foursquare.com/v2/venues/search?limit=10&ll=25.033611,121.564444&client_id=BXTCY4HGTLWINDPRLFXCOWRUEDAJC12ZHEGDTGX4A5DX413K&client_secret=X20DAZW4CXKKC2V1O4QXYYHEQ1T5BMIBHUYD5ZJOVUKGFD3V&v=20140726");

$json = json_decode($str);

//var_dump($json);

echo "<br><br>===============<br><br>";

//echo $json->response->venues[0]->id;


echo $str;

//echo utf8_decode($str); 


?>

</html>