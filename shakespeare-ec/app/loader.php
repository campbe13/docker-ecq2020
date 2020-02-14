<?php
include "./classes/RedisDataLoader.php";

$dataLoader = new RedisDataLoader();
$dataLoader->loadData('shakespeare_input.txt');
?>
