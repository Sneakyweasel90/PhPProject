<?php

session_start();
include ("connect.php");

//this page will allow the user to edit their profile photo
if (isset($_GET["message"])){
    $message = $_GET["message"];
    echo "<script> alert('$message') 
	window.location.href='edit_photo.php'</script>"; 
	//put in the window.location so that when the user clicks follow it resets the link to default
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Upload a photo to your profile for everyone to see who you are!">
	<meta name="author" content="Neil Mannion, neil.mannion1@gmail.com">
    <link rel="icon" href="favicon.ico">

    <title>Edit Profile Photo</title>

    <link href="includes/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="includes/starter-template.css" rel="stylesheet">
    <!-- Bootstrap core JavaScript-->
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


</head>


<body>
    <?php include("Includes/header.php"); ?>

    <br><br><br><br><br><br>

    <div class="container">
        <div class="row">

            <div class="main-login main-center">
                <h5>Upload your own profile picture here! Make it fun for your friends!</h5>
                <form action="edit_photo_proc.php" method="post" enctype="multipart/form-data">
                    <label >Select image to upload:</label>
                    <input type="file" name="photo" required="required">
                    <input type="submit" name="submit" value="Upload Image">
                </form>
            </div>

        </div> <!-- end row -->
    </div><!-- /.container -->
</body>

</html>