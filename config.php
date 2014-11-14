<?php
$dbhost="localhost";
$dbuser="root";
$dbpassword="";
$dbname="retouchify";

$conn=mysql_connect($dbhost,$dbuser,$dbpassword);
$db=mysql_select_db($dbname);

if(!$conn)
{
	echo "could not connect database";
}

?>