<?php

include_once('connect.php');

if (!isset($_SESSION["SESS_MEMBER_ID"])) {
	
	header("location:Login.php");
}

class Tweet {
    private $tweetId;
    private $originalTweetId;
    private $tweetText;
    private $replyToTweetId;
    private $userID;
    private $dateAdded;

    // Constructor
    public function __construct($tweetText, $userId, $originalTweetId = null, $replyToTweetId = null) {
        $this->tweetText = $tweetText;
        $this->userID = $userId;
        $this->originalTweetId = $originalTweetId;
        $this->replyToTweetId = $replyToTweetId;
        $this->dateAdded = date('Y/m/d');
    }

    public function getTweetId() {
        return $this->tweetId;
    }
    // public function setTweetId($tweetId) { //already done in the database
    //     $this->tweetId = $tweetId;
    // }

    public function getOriginalTweetId() {
        return $this->originalTweetId;
    }
    public function setOriginalTweetId($originalTweetId) {
        $this->originalTweetId = $originalTweetId;
    }

    public function getTweetText() {
        return $this->tweetText;
    }
    public function setTweetText($tweetText) {
        $this->tweetText = $tweetText;
    }

    public function getReplyToTweetId() {
        return $this->replyToTweetId;
    }
    public function setReplyToTweetId($replyToTweetId) {
        $this->replyToTweetId = $replyToTweetId;
    }

    public function getUserId() {
        return $this->userID;
    }
    
    public function getDateAdded() {
        return $this->dateAdded;
    }
    public function setDateAdded($dateAdded) {
        $this->dateAdded = $dateAdded;
    }

    //!!!!CRUD METHODS!!!!
    function FindTweet($con, $userID) { 
        $sql = "SELECT `t`.`tweet_id`, `t`.`tweet_text`, `t`.`user_id`, `t`.`original_tweet_id`, `t`.`reply_to_tweet_id`, `t`.`date_created`, 
                    `u`.`first_name`, `u`.`last_name`, `u`.`screen_name`, `u`.`profile_pic`
                FROM tweets t
                JOIN users u ON `t`.`user_id` = `u`.`user_id`
                WHERE `u`.`user_id` = $userID
                OR `u`.`user_id` IN (SELECT `follows`.`to_id` FROM follows WHERE `follows`.`from_id` = $userID)
                ORDER BY `t`.`date_created` DESC
                LIMIT 10"; 

                //Select statement having logged in users tweets as well as all the other tweets from the users they are following.
                //Very confusing to get it all right with all the backticks

        $result = mysqli_query($con, $sql);

        if (mysqli_num_rows($result) > 0) {
            $tweets = [];

            while ($row = mysqli_fetch_assoc($result)) {
                $tweets[] = [
                    'user_id' => $row['user_id'],
                    'tweet_id' => $row['tweet_id'],
                    'tweet_text' => $row['tweet_text'],
                    'original_tweet_id' => $row['original_tweet_id'],
                    'reply_to_tweet_id' => $row['reply_to_tweet_id'],
                    'date_created' => $row['date_created'],
                    'first_name' => $row['first_name'],
                    'last_name' => $row['last_name'],
                    'screen_name' => $row['screen_name'],
                    'profile_pic' => $row['profile_pic']
                ];
            }

            return $tweets;
        } else {
            return []; // Return an empty array if no tweets found
        }
    }
}

?>