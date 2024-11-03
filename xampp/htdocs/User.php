<?php
include_once('connect.php');


if (!isset($_SESSION["SESS_MEMBER_ID"])) {
	
	header("location:Login.php");
}


class User {
    private $userId;
    private $userName;
    private $password;
    private $firstName;
    private $lastName;
    private $address;
    private $province;
    private $postalCode;
    private $contactNo;
    private $email;
    private $dateAdded;
    private $profImage;
    private $location;
    private $description;
    private $url;

    public function __construct($userName, $password, $firstName, $lastName, $address, $province, $postalCode, $contactNo, $email, $profImage = null, $location = null, $description = null, $url = null) {
        $this->userName = $userName;
        $this->password = $password;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->address = $address;
        $this->province = $province;
        $this->postalCode = $postalCode;
        $this->contactNo = $contactNo;
        $this->email = $email;
        $this->profImage = $profImage;
        $this->location = $location;
        $this->description = $description;
        $this->url = $url;
        $this->dateAdded = date('Y/m/d');
    }

    public function __get($property) {
        //this will return any private data member
        return $this->$property;
    }

    public function __set($property, $value) {
        $this->$property = $value;
    }



    //CRUD 
    function FindUser($con, $userID){
        $sql = "SELECT `u`.`user_id`,`u`.`screen_name`,`u`.`first_name`,`u`.`last_name`, `u`.`profile_pic`
        FROM users u
        where `u`.`user_id` != $userID
        AND `user_id` NOT IN (SELECT `follows`.`to_id` FROM follows WHERE `follows`.`from_id` = $userID)
        ORDER BY RAND()
        LIMIT 3";


        $result = mysqli_query($con, $sql);

        if (mysqli_num_rows($result) > 0) {

            $users = [];

            while ($row = mysqli_fetch_assoc($result)) {
                $users[] = [
                    'user_id' => $row['user_id'],
                    'screen_name' => $row['screen_name'],
                    'first_name' => $row['first_name'],
                    'last_name' => $row['last_name'],
                    'profile_pic' => $row['profile_pic']
                ];
            }

            //$_SESSION['FOLLOWED_USERS'] = $users;
            return $users;
        }
    }

    function AddUser($con){

        $hash_password = password_hash($this->password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO `users`
        (`first_name`,`last_name`,`screen_name`,`password`,`address`,`province`,`postal_code`,`contact_number`,`email`,`url`,`description`,`location`)
        VALUES ('$this->firstName', '$this->lastName', '$this->userName', '$hash_password', '$this->address', '$this->province', '$this->postalCode', '$this->contactNo', '$this->email', '$this->url', '$this->description', '$this->location')";
    
        mysqli_query($con, $sql);
        if (mysqli_affected_rows($con) == 1){
            $msg = "Account created";
            header("location:login.php?message=$msg");
        }
        else {
            $msg = "Account not created";
            header("location:Signup.php?message=$msg");
        }
        //echo $msg; //Make sure to have the default page
    }

    function SelectUser($con){
        $sql = "Select `screen_name`, `password`, `first_name`, `last_name`, `user_id`
        FROM `users`
        WHERE `screen_name` = '$this->userName'";//make sure not to have the schema name
    
        $result = mysqli_query($con, $sql);
    
        if (mysqli_num_rows($result) == 1){
            $row = mysqli_fetch_assoc($result);
    
            $hash_password = $row['password'];
    
            if (password_verify($this->password, $hash_password)) {
            
            $_SESSION["SESS_FIRST_NAME"] = $row['first_name'];
            $_SESSION["SESS_LAST_NAME"] = $row['last_name'];
            $_SESSION["SESS_MEMBER_ID"] = $row['user_id'];
            $_SESSION["SESS_SCREEN_NAME"] = $row['screen_name'];
            
            $msg = "Logged In";
            //comment this out and try to echo out the information that you need on this page.
            
            // echo $_SESSION["SESS_FIRST_NAME"];
            // echo $_SESSION["SESS_LAST_NAME"];
            // echo $_SESSION["SESS_MEMBER_ID"];
            header("location:Index.php?message=$msg");
            }
            else{
                $msg = "Login Unsuccessful. Password is incorrect";
                header("location:Login.php?message=$msg");
                return false;
            }
    
            
        }
        else {
            $msg = "Login Unsuccessful. Account does not exist";
            header("location:Login.php?message=$msg");
        }
        //echo $msg; //Make sure to have the default page
    }

    function updateProfilePic($con, $fileName){
        
        $msg = "FILE UPLOADED SUCCESSFULLY";

        $sql = "UPDATE `users` SET `profile_pic` = '$fileName' WHERE `user_id` = $this->userId"; //At this stage, Getting the image uploaded to the database

        if (mysqli_query($con, $sql) == 1){
            $msg = "Photo Uploaded";
            header("location:index.php?message=$msg");
            exit();
        }
        else {
            $msg = "Photo not Uploaded";
            header("location:edit_photo.php?message=$msg");
            exit();
        }
    }

    
}

?>