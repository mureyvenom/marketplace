<?php

$connect = mysqli_connect('localhost', 'paycol', 'certification231', 'paycol');

if(!$connect)
{
	echo 'Database connection error';
	exit;
}

?>
