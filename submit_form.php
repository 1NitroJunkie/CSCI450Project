<?php

$host="den1.mysql2.gear.host";
$port=3306;
$socket="";
$user="campreg";
$password="";
$dbname="campreg";

$con = new mysqli($host, $user, $password, $dbname, $port, $socket)
	or die ('Could not connect to the database server' . mysqli_connect_error());

$con->close();