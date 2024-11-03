<?php
session_start();
include("connect.php");

// if the user is logged in and the tweet_id is there
if (!isset($_SESSION["SESS_MEMBER_ID"]) || !isset($_GET['tweet_id'])) {
    header("Location: index.php");
    exit();
}

$userID = $_SESSION["SESS_MEMBER_ID"];
$originalTweetID = $_GET['tweet_id'];

//echo $originalTweetID; debugging

$tweetTextQuery = "SELECT tweet_text FROM tweets WHERE tweet_id = $originalTweetID";

$resultText = mysqli_query($con, $tweetTextQuery);

if ($resultText && mysqli_num_rows($resultText) > 0) {
    $row = mysqli_fetch_assoc($resultText);
    $tweetText = $row['tweet_text'];
    $originalTweet = $row['original_tweet'];

    $insertQuery = "INSERT INTO tweets (user_id, tweet_text, original_tweet_id) VALUES ($userID, '$tweetText', $originalTweetID)";
    $resultInsert = mysqli_query($con, $insertQuery);

    if ($resultInsert) {
        header("location: index.php?message=Retweeted!");
    }
    else {
        header("location: index.php?message=ERROR with retweet;");
    }
}

?>
