<?php

$str = httpGet('https://www.flickr.com/photos/microrna850/11236942906/');

$url = "after.php?content=" . $str;

$back = httpGet($url);

echo $back;

?>