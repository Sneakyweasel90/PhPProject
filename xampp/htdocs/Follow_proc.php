<?php

require_once("connect.php"); //Had to put this in here because it was giving me a ton of errors and wouldnt work without this


if (!isset($_SESSION["SESS_MEMBER_ID"])) {
	
	header("location:Login.php");
}


if (session_status() == PHP_SESSION_NONE) { //Create a session if there isn't one started
    session_start();
}

if (isset($_GET['user_id'])) { //Get the user_id and the sess_member_id
    $followedUser = $_GET['user_id'];
    $user = $_SESSION["SESS_MEMBER_ID"];

    FollowUser($con, $followedUser, $user);  //call the function
}


function FollowUser($con, $followedUser, $user) {
    $sql = "INSERT INTO `follows` (`to_id`, `from_id`) VALUES ($followedUser, $user)"; //insert 

    mysqli_query($con, $sql);
    if (mysqli_affected_rows($con) == 1){
        $msg = "Followed user!";
        header("location:Index.php?message=$msg");
    }
    else {
        $msg = "No one followed";
        header("location:Index.php?message=$msg");
    }
}


?>