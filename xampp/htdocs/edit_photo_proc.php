<?php 
//this file will handle the file uploading and return the user back to the edit_photo page.
session_start();
include ("connect.php");
include ("User.php");

$userId = $_SESSION["SESS_MEMBER_ID"];
$user = new User($userName, $password, $firstName, $lastName, $address, $province, $postalCode, $contactNo, $email, $profImage, $location, $desc, $url);
$user->userId = $userId;


$msg = "Successful"; //Initialize the variable to send a msg back to the main form
//make sure the user cannot get to this page directly when typing into there own browser
if (isset($_POST["submit"])){
    //attempt to upload the file
    if (empty($_FILES["photo"])){
        $msg = "YOU MUST UPLOAD A PHOTO";
        header("location:edit_photo.php?message=$msg");
    }

    //echo $_FILES["photo"]["size"] . "<BR>";
    //echo $_FILES["photo"]["tmp_name"] . "name<BR>";
    //print_r([$_FILES]);

    $MAX_FILE_SIZE = 5 * 1024 * 1024; //5MB in bytes

    //You can check to see if the file size works. I placed a photo in the profilepics called Snake_river. its 5Mb and triggers it to not upload.

    if($_FILES["photo"]["size"] > $MAX_FILE_SIZE){
        $msg = "FILE SIZE MUST BE LESS THAN 5Mb";
        unlink($_FILES["photo"]["tmp_name"]);//delete the temp file
        
    }
    else {//everything is good
        $fileName = $userId . '.jpg';//to change the name of the file
        $moveFile = "Images/profilepics/" . $fileName; //make sure to name the new file

        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $moveFile)) {

            //refactored in here. Created a function to pass in the filename and update it
            if ($user->updateProfilePic($con, $fileName)) { 
                $msg = "Photo Uploaded";
                header("location:index.php?message=$msg");
            } else {
                $msg = "Photo not Uploaded to Database";
                header("location:edit_photo.php?message=$msg");
            }
        } else {
            $msg = "ERROR UPLOADING FILE";
            unlink($_FILES["photo"]["tmp_name"]);
            header("location:edit_photo.php?message=$msg");
        }
    }
    echo $msg;
    header("location:edit_photo.php?message=$msg");
}
else{
    echo "YOU CAN'T ACCESS THIS PAGE DIRECTLY";
}

?>