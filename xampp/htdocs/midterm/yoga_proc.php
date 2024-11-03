<?php
//4U2DO - write that will connect to the DB. Then grab the user's form data from the post.
//		then insert a record into the signup table of the database and redirect the user back to index.php
//		then add logic that will query the signup table to see if any records already exist for that email address
 
session_start();

include_once("connect.php");


if (isset($_POST['txtName']) && isset($_POST['cboClass'])){

    $name = $_POST["txtName"];
    $class = $_POST["cboClass"];
    $email = $_POST["txtEmail"];

    CheckUser ($con, $name, $class, $email);
}
else {
    echo "CAN'T ACCESS THIS PAGE DIRECTLY";
}


function InsertData ($con, $name, $class, $email){
    $sql = "INSERT INTO `signup` (`name`, `class`, `email`) VALUES ('$name', '$class', '$email')";
    $msg = "";

    mysqli_query($con, $sql);
    if (mysqli_affected_rows($con) == 1){
        $msg = "SIGNUP SUCCESSFUL";
        header("location:index.php?message=$msg");
    }
    else {
        $msg = "SIGNUP FAILED";
        header("location:index.php?message=$msg");
    }
}

//Unchecked the Unique for the Email in the database. Couldn't get this to work if it was on. 
//I am checking to see if the user is already signed up for the time they have in the database and not the email associated with it.

function CheckUser ($con, $name, $class, $email) {

   
        $sql = "SELECT `name`, `class` FROM `signup` WHERE `name` = '$name' AND `class` = '$class' AND `email` = '$email'";
        $msg = "";

        mysqli_query($con, $sql);

        if (!mysqli_affected_rows($con) == 1) {

            InsertData($con, $name, $class, $email);
            
        }
        else {
            $msg = "YOU ARE ALREADY SIGNED UP FOR THIS CLASS";
            header("location:index.php?message=$msg");
        }
    
}

?>