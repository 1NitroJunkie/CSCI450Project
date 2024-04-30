<?php

$host="den1.mysql3.gear.host";
$port=3306;
$socket="";
$user="campregistration";
$password="";
$dbname="";

$con = new mysqli($host, $user, $password, $dbname, $port, $socket)
	or die ('Could not connect to the database server' . mysqli_connect_error());

$con->close();