

<?php

require('category.php');

$a = new category;
$b = new category;
$c = new category;

$a->pName = "123";
$a->dist = 111;

$b->pName = "456";
$b->dist = 222;

$c->pName = "789";
$c->dist = 333;

$kkman = Array();

array_push($kkman, $b);

array_push($kkman, $a);

array_push($kkman, $c);

var_dump($kkman);

echo "<br><br>";

usort($kkman, "cmpCate");

var_dump($kkman);

?>



