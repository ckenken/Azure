<?php

function httpGet($url)
{
    $ch = curl_init();  
 
 	curl_setopt($ch,CURLOPT_HEADER, false); 
 	curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch,CURLOPT_URL, $url);
   // curl_setopt($ch, CURLOPT_ENCODING ,"");
 	curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);


    $output=curl_exec($ch);
 
    curl_close($ch);
    return $output;
}

?>