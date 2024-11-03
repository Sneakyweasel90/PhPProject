<?php
//internet is stateless - every page has no knowledge of other pages
session_start(); //use this on every page that requires sessions variables
echo session_id() . "<br>";
//this is similar to what you will use in login_proc.php
$_SESSION["name"] = "Neil";//set the session variable
echo $_SESSION["name"] . " name stored in sessions<br>"; //get the session variable

echo session_encode() . " ALL MY SESSION VARIABLES<BR>";
echo session_decode(session_encode()) . " number of variables in sessions <br>";

//session variables are used A LOT in shopping carts, online banking, brightspace
//try not to keep track of user preferences
//Don't put too much in session variables maybe just user_id, First Name etc.
//call the database to get anything else you need
?>

<a href="Logout.php"> Click here to log out</a>