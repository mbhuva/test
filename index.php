<?php
//error_reporting(0);
include('config.php');

$option=$_GET['option'];
$view=$_GET['view'];
$task=$_GET['task'];
if(file_exists($option.'/'.$view.'/index.php'))
{
	include($option.'/'.$view.'/index.php');
}

?>