<?php
//add code here to process the file upload.
//step 1 - move the file from the TMP directory to it's permanent home, renaming the file if needed
//step 2 - delete the file from the TMP directory if there is an error.
//step 3 - update the users table in the DB with the new file.


$message = "Successful"; //Initialize the variable to send a message back to the main form
//make sure the user cannot get to this page directly when typing into there own browser
if (isset($_POST["submit"])){
    //attempt to upload the file
    if (empty($_FILES["photo"])){
        $message = "YOU MUST UPLOAD A PHOTO";
        exit; //this is like a break statement
    }

    echo $_FILES["photo"]["size"] . "<BR>";
    echo $_FILES["photo"]["tmp_name"] . "name<BR>";
    //print_r([$_FILES]);

    $MAX_FILE_SIZE = 5 * 1024 * 1024; //5MB in bytes

    if($_FILES["photo"]["size"] > $MAX_FILE_SIZE){
        $message = "FILE SIZE MUST BE LESS THAN 5Mb";
        unlink($_FILES["photo"]["tmp_name"]);//delete the temp file
        
    }
    else {//everything is good
        $deskFile = "../Images/profilepics/" . $_FILES["photo"]["name"];
        if(move_uploaded_file($_FILES["photo"]["tmp_name"], $deskFile)){
            $message = "FILE UPLOADED SUCCESSFULLY";

            //use the session variable to get the user id of the currently logged in user
            //when you move the file, rename it to $_SESSION["SESSION_USER_ID"].jpg
            //update the users table with the new file name
        }
        else{
            $message = "ERROR UPLOADED FILE";
            unlink($_FILES["photo"]["tmp_name"]);
        }    
    }
    echo $message;
    header("location:Chap15-Uploads.php?msg=$message");
}
else{
    echo "YOU CAN'T ACCESS THIS PAGE DIRECTLY";
}

?>