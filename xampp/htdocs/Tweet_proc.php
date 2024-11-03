<?php 
require_once("connect.php");

//insert a tweet into the database
if (session_status() == PHP_SESSION_NONE) { //Create a session if there isn't one started
    session_start();
}

if (!isset($_SESSION["SESS_MEMBER_ID"])) { //check if the user is logged in
    header("location:Login.php");
}

$userID = $_SESSION["SESS_MEMBER_ID"];

if ($_SERVER["REQUEST_METHOD"] == "POST") { //Taking the information from the submit form from index.php
    
    $tweetContent = trim($_POST['myTweet']); // Get the tweet content from the form

    
    if (!empty($tweetContent)) {// Make sure the tweet is not empty

        // Create the statement first!!!!!! this also gets rid of the special characters!
        $sql = "INSERT INTO tweets (`user_id`, `tweet_text`) VALUES ('" 
                . mysqli_real_escape_string($con, $userID) . 
                "', '" 
                . mysqli_real_escape_string($con, $tweetContent) .
                "')";

        //insert the query into the database. show a good or bad message 		
        if (mysqli_query($con, $sql)) {
            $insert_id = mysqli_insert_id($con);

            header("Location: index.php?message=Tweet posted successfully!");
        }
        else {
            header("Location: index.php?message=Error posting tweet.");
        }
    } else {
        
        header("Location: index.php?message=Tweet cannot be empty."); // Redirect back if the tweet is empty
    }
}


?>