<?php
session_start();
//unset($_SERVER["PHP_AUTH_USER"]);

//these 3 lines will be basically what we need on the sprint
session_unset();//free all session variables
session_destroy();//kills the session completely
header("location:Login.php");
//log the user out and redirect them back to the login page.
?>