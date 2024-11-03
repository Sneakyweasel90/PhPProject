<?php 
//verify the user's login credentials. if they are valid redirect them to index.php/
//if they are invalid send them back to login.php
include ("connect.php");
require_once ("User.php");
?> 
<?php 
session_start();
//$users = $_SESSION['FOLLOWED_USERS'];  commented out because not sure its here

if (isset($_POST["username"]) && isset($_POST["password"])) {
    $userName = $_POST["username"];
    $password = $_POST["password"];

    $user = new User($userName, $password, $firstName, $lastName, $address, $province, $postalCode, $contactNo, $email, $profImage, $location, $desc, $url);
    $user->SelectUser($con);


}
else{
    echo "CAN'T ACCESS THIS PAGE DIRECTLY";
}
?>