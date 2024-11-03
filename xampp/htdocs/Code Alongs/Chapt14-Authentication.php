<?php
session_start();
//this is really good way to authenticate someone if you don't have a DB
//associative array to hold username/password info
//unset($_SERVER["PHP_AUTH_USER"]);
$valid_password = array("jimmy" => "opensesame");
$valid_users = array_keys($valid_password);

echo $_SESSION["name"] . " name stored in sessions<br>";

$user = $_SERVER['PHP_AUTH_USER'];//the username they entered
$pass = $_SERVER['PHP_AUTH_PW'];//the password they entered

$validated = in_array($user, $valid_users) && $pass == $valid_password[$user];
echo $validated . "<br>";
if (!$validated){
    header("WWW-Authenticate: Basic realm=myRealm"); //header("WWW-Authenticate: Basic-realm");: This sends an HTTP header to the browser. The "WWW-Authenticate" header is used to prompt the browser to show a login dialog for basic authentication. The "Basic-realm" part indicates that the type of authentication is "Basic" and the realm (a description of the protected area) is not fully specified in this case.
    header("HTTP/1.0 401 Unauthorized");
    die("NOT AUTHORIZED");
}
echo "<p> Welcome $user, Congrats on getting into the system.<br>";

//on Y, your login_proc.php path will select from the users table where the screen_name equals whatever they entered and the password equals whatever they entered.
//If any records come back they are successfully authenticated
//if NO records found, display an error and ask them to try again
?>

<a href="Logout.php"> Click here to log out</a>