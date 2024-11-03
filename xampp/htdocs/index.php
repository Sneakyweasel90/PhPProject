<?php
//this is the main page for our Y website, 
//it will display all posts from those we are trolling
//as well as recommend people we should be trolling.
//you can also post from here
session_start();
// Check if the session variables are set (i.e., user is logged in)

if (isset($_GET["message"])){
    $message = $_GET["message"];
    echo "<script> alert('$message')
	window.location.href='index.php'</script>";
	//put in the window.location so that when the user clicks follow it resets the link to default
}


if (!isset($_SESSION["SESS_MEMBER_ID"])) {
	
	header("location:Login.php");
}


//Testing to see what is being stored
echo "<br><br>";
// echo $_SESSION["SESS_FIRST_NAME"];
// echo $_SESSION["SESS_LAST_NAME"];
// echo $_SESSION["SESS_MEMBER_ID"];
// echo $_SESSION["SESS_SCREEN_NAME"];

//$users = $_SESSION['FOLLOWED_USERS'];
//echo $_SESSION["SESS_SCREEN_NAME"];

$userID = $_SESSION["SESS_MEMBER_ID"]; //create the userID before calling the function in the include file

include("Follow_proc.php"); //follow button sql statements
include("Tweet_proc.php"); //Page for submit button for tweets
include("User.php");
include("Tweet.php");

$users = new User("","","","","","","","","","","","","");
$usersList = $users->FindUser($con, $userID); 

$tweets = new Tweet("", $userID, "", "");
$tweetsList = $tweets->FindTweet($con, $userID);

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Explore the latest posts and discover who to troll next on Y. Post, interact, and have fun with trending topics and user profiles. Why use X when you can use Y!">
	<meta name="author" content="Neil Mannion, neil.mannion1@gmail.com">
	<link rel="icon" href="favicon.ico">

	<title>Y - Why use X when you can use Y!</title>

	<!-- Bootstrap core CSS -->
	<link href="includes/bootstrap.min.css" rel="stylesheet">

	<!-- Custom styles for this template -->
	<link href="includes/starter-template.css" rel="stylesheet">
	<!-- Bootstrap core JavaScript-->
	<script src="https://code.jquery.com/jquery-1.10.2.js"></script>

	<script>
		//just a little jquery to make the textbox appear/disappear like the real Twitter website does
		$(document).ready(function() {
			//hide the submit button on page load
			$("#button").hide();
			$("#tweet_form").submit(function() {

				$("#button").hide();
			});
			$("#myTweet").click(function() {
				this.attributes["rows"].nodeValue = 5;
				$("#button").show();

			}); //end of click event
			$("#myTweet").blur(function() {
				this.attributes["rows"].nodeValue = 1;
				//$("#button").hide();

			}); //end of click event
		}); //end of ready event handler
	</script>
</head>

<body>
	<!-- include the header page for use of ease across all pages -->
	<?php include("Includes/header.php"); ?>

	<BR><BR>
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				<div class="mainprofile img-rounded">
					<div class="bold">
						<img class="bannericons" alt="Elon Musk Silouette" src="<?php echo $profilePic . '?t=' . time(); ?>">
						<a href="userpage.php?user_id=">Jimmy Jones</a><BR>
					</div>
					<table>
						<tr>
							<td>
								tweets</td>
							<td>following</td>
							<td>followers</td>
						</tr>
						<tr>
							<td>0</td>
							<td>0</td>
							<td>0</td>
						</tr>
					</table><BR><BR><BR><BR><BR>
				</div><BR><BR>
				<div class="trending img-rounded">
					<div class="bold">Trending</div>
				</div>

			</div>
			<div class="col-md-6">
				<div class="img-rounded">
					<form method="post" id="tweet_form" action="tweet_proc.php">
						<div class="form-group">
							<textarea class="form-control" name="myTweet" id="myTweet" rows="1" placeholder="What's on your mind?"></textarea>
							<input type="submit" name="button" id="button" value="Send" class="btn btn-primary btn-lg btn-block login-button">

						</div>
					</form>
				</div>
				<div class="img-rounded">
					<!--display list of tweets here-->
					<?php 
					
					function DisplayTweet($tweets, $con) {
						$fullName = $tweets['first_name'] . " " . $tweets['last_name'];
						$screenName = "@" . $tweets['screen_name'];
						$tweet = $tweets['tweet_text'];
						$tweetTime = new DateTime($tweets['date_created']);

						//no idea how else to do this part. Im guessing this is what you wanted?
						$originalTweetInfo = "";
						if (!empty($tweets['original_tweet_id'])) {
							
							$originalTweetQuery = "SELECT user_id FROM tweets WHERE tweet_id = " . $tweets['original_tweet_id'];
							$originalTweetResult = mysqli_query($con, $originalTweetQuery);
							
							if ($originalTweetResult && mysqli_num_rows($originalTweetResult) > 0) {
								$originalTweetRow = mysqli_fetch_assoc($originalTweetResult);
								$originalUserID = $originalTweetRow['user_id'];

								
								$originalUserQuery = "SELECT first_name, last_name FROM users WHERE user_id = $originalUserID";
								$originalUserResult = mysqli_query($con, $originalUserQuery);
								
								if ($originalUserResult && mysqli_num_rows($originalUserResult) > 0) {
									$originalUserRow = mysqli_fetch_assoc($originalUserResult);
									$originalUserFullName = $originalUserRow['first_name'] . " " . $originalUserRow['last_name'];
									
									$originalTweetInfo = "  Retweeted from $originalUserFullName";
								}
							}
						}
						
						date_default_timezone_set('America/Halifax');
						$currentTime = date_create(); //create a new date
						
						// Calculate the difference
						$interval = date_diff($tweetTime, $currentTime);
						
						// Format the elapsed time
						if ($interval->y > 0) {
							$timeAgo = $interval->y . ' year' . ($interval->y > 1 ? 's' : '') . ' ago';
						} elseif ($interval->m > 0) {
							$timeAgo = $interval->m . ' month' . ($interval->m > 1 ? 's' : '') . ' ago';
						} elseif ($interval->d > 0) {
							$timeAgo = $interval->d . ' day' . ($interval->d > 1 ? 's' : '') . ' ago';
						} elseif ($interval->h > 0) {
							$timeAgo = $interval->h . ' hour' . ($interval->h > 1 ? 's' : '') . ' ago';
						} elseif ($interval->i > 0) {
							$timeAgo = $interval->i . ' minute' . ($interval->i > 1 ? 's' : '') . ' ago';
						} else {
							$timeAgo = $interval->s . ' seconds' . ($interval->s > 1 ? 's' : '') . ' ago';
						}
					
						//display the profile pic for the user
						$profilePic = !empty($tweets['profile_pic']) ? $tweets['profile_pic'] : "Images/profilepics/ElonSilouette.jpg";
					
						if (!file_exists($profilePic) && !empty($tweets['profile_pic'])) {
							$profilePic = "Images/profilepics/" . $tweets['profile_pic'];
						}
					
						if (!file_exists($profilePic)) {
							$profilePic = "Images/profilepics/ElonSilouette.jpg";
						}
					
						echo "
						<div class='userItem'>
							<div class='userName'>
								<img src='$profilePic' alt='Profile Picture' class='bannericons' />
								<span style='color: blue;'>$fullName $screenName </span><small>$timeAgo</small><b>$originalTweetInfo</b><br>
								$tweet
							</div>
							<button><img src='Images/like.ico' height='40px'></img></button>
							<button><img src='Images/reply.png' height='40px'></img></button>
        					<a href='retweet.php?tweet_id={$tweets['tweet_id']}'><button><img src='Images/retweet.png' height='40px'></button></a>						</div> <hr>
						";
					}
					
					// Loop through the users and display each one
					if (!empty($tweetsList)) {
						foreach ($tweetsList as $tweet) {
							DisplayTweet($tweet, $con);
						}
					} else {
						echo "No users found.";
					}
					?>

				</div>
			</div>
			<div class="col-md-3">
				<div class="whoToTroll img-rounded">
					<div class="bold">Who to Troll?<br></div>
					<!-- Display people you may know here -->


					<div class="userList">
						<?php
						function DisplayUser($user) //user comes from the function FindUser
						{
							$fullName = $user['first_name'] . " " . $user['last_name'];
							$screenName = "@" . $user['screen_name'];
							// Use the profile pic from the database if available
							$profilePic = !empty($user['profile_pic']) ? $user['profile_pic'] : "Images/profilepics/ElonSilouette.jpg";

							if (!file_exists($profilePic) && !empty($user['profile_pic'])){ //making sure the image is there or not
								$profilePic = "Images/profilepics/" . $user['profile_pic']; //using the user from the array to get the picture name
							}

							if (!file_exists($profilePic)){ // default the elon image to the picture
								$profilePic = "Images/profilepics/ElonSilouette.jpg";
							}
							
							//this is for outputting the information to the page while looping through the array.
							echo "
							<div class='userItem'>
								<div class='userName'>
									<img src='$profilePic' alt='Profile Picture' class='bannericons' />
									<span style='color: blue;'>$fullName $screenName </span>
								</div>
								<a href='Follow_proc.php?user_id=$user[user_id]' style='background-color: blue; color: white' class='followButton'>Follow</a> 
								<br><br>
							</div>
							";
						}
						
						// Loop through the users and display each one
						if (!empty($usersList)) {
							foreach ($usersList as $user) {
								DisplayUser($user);
							}
						} else {
							echo "No users found.";
						}
						?>
					</div><!--End of the Output for users Index Page-->


				</div>
				<br>
				

				<!-- don't need this div for now 
				<div class="trending img-rounded">
				© 2024 Y
				</div> -->
			</div>
		</div> <!-- end row -->
	</div><!-- /.container -->



	<!-- Bootstrap core JavaScript
    ================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
	<script src="includes/bootstrap.min.js"></script>

</body>

</html>