<?php
//these are defined as constants
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
//define('DB_NAME', 'y-neil'); //This is for the sprint
//define('DB_NAME', 'productsdemo'); //code alongs


define('DB_NAME', 'yoga');

global $con;
	  $con = mysqli_connect(DB_HOST,DB_USER,DB_PASS, DB_NAME);
if (!$con)
  {
  die('Could not connect: ' . mysqli_connect_error());
  }
?>