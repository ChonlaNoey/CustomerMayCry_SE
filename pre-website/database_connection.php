<?php 

//database_connection.php

$connect = new PDO("mysql:host=localhost;dbname=soften", "root","", array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

?>