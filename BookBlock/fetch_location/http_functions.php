<?php

function httpGet($url)
{
    $ch = curl_init();  
 
  //  echo "<br>" . $url . "<br>";

 	curl_setopt($ch,CURLOPT_HEADER, false); 
 	curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
     curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);  //?
    curl_setopt($ch,CURLOPT_URL, $url);
   // curl_setopt($ch, CURLOPT_ENCODING ,"");
 	curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.17 (KHTML, like Gecko) Chrome/24.0.1312.52 Safari/537.17');
    curl_setopt($ch, CURLOPT_AUTOREFERER, true);

    $output=curl_exec($ch);
	 
  //  var_dump($output);

	if($output === false)
	{
		curl_close($ch);
	    return curl_error($ch);
	}

    curl_close($ch);
    return $output;
}

?>