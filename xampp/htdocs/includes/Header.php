<?php

require_once("connect.php"); //Had to put this in here because it was giving me a ton of errors and wouldnt work without this

if (session_status() == PHP_SESSION_NONE) { //Create a session if there isn't one started
    session_start(); 
}

  if (isset($_SESSION["SESS_MEMBER_ID"])){
    $user = $_SESSION["SESS_MEMBER_ID"];

    $profilePic = UpdateProfileImage($user);

    //echo "<script>console.log('Profile Picture Path: " . $profilePic . "');</script>"; //debugging
  }

  function UpdateProfileImage($user) {
    $profilePath = 'images/profilepics/' . $user . '.jpg'; // Correct path

    // Check if the user's profile picture exists
    if (file_exists($profilePath)) {
        return $profilePath; // Return the user's profile picture
    } else {
        return 'images/profilepics/ElonSilouette.jpg'; // Return default if not found
    }
}

?>

<nav class="navbar navbar-toggleable-md navbar-inverse bg-inverse fixed-top">
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
     

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
		<li>
		  <a class="navbar-brand" href="#"><img alt="Y Logo" src="images/y_logo.png" class="logo"></a>
		  </li>
          <li class="nav-item">
            <a class="nav-link active" href="index.php">
			<img class="bannericons" alt="Home Icon" src="images/home.jfif">Home<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
			<img class="bannericons" alt="Trending Icon" src="images/lightning.png">Moments</a>
          </li>
		  <li class="nav-item">
            <a class="nav-link" href="Notifications.php">
			<img class="bannericons" alt="notification icon" src="images/bell.png">Notifications</a>
          </li>
		  <li class="nav-item">
            <a class="nav-link" href="#">
			<img class="bannericons" alt="Messages Icon" src="images/messages.png">Messages</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="ContactUs.php">
			<img class="bannericons" alt="Contact us Icon" src="images/ContactUs.png">Contact Us</a>
          </li>
		  <li class="nav-item dropdown right">
            <a class="nav-link dropdown-toggle" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			<img class="profilepic" alt="Profile Picture" src="<?php echo $profilePic . '?t=' . time(); ?>">
			</a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" href="../Logout.php">Logout</a>
              <a class="dropdown-item" href="edit_photo.php">Edit Profile Picture</a>
              
            </div>
          </li>  
        </ul>
		
        <form class="form-inline my-2 my-lg-0" action="search.php">
          <input class="form-control mr-sm-2" type="text" placeholder="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
      </div>
    </nav>