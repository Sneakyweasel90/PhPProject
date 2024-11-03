<?php

//login_proc.php
//1. grab the username and password
//2. write a sql statement to query the users table
//2.1 if no record found, return the user to login.php with a friendly error message
//2.2 if record is FOUND, store user_id in session variable and redirect user to the index page

//logout.php
//3 lines of code to kill the session and redirect the user back to login.php

//index.php
//1. write an sql statement to get a random list of 3 people to follow
//1.1 exclude the person who is logged in currently.
//1.2 exclude users they already follow

//SELECT user_id, first_name, last_name, screen_name, profile_pic FROM users WHERE user_id !=22 
    // AND user_id (select to_id FROM follows WHERE from_id = 22) order by rand() limit 3


//2. Loop through the list to display them in the "who to troll" on the index.php with their first name, last name, screen name
//3. You have to build a URL querystring to get to follow_proc.php?user_id=1234 when the user clicks the button
//Clicks the button

//Follow_proc.php
//1. grab the user_id from the UL querystring with $_GET['user_id']
//2. Insert into the follow table
//2.1 the from_id is the currently logged in user (grab from session)
//2.2 the to_id is the user_id of the person being followed (grab the URL)
//3. redirect them back to index.php with header("location")



//Sprint 3 encrypting the password
//imagine this is on signup_proc.php
$password = $_POST["txtPassword"];
$password = password_hash($password, PASSWORD_DEFAULT);
echo "ENCYPTED PASSWORD " . $password . "<br>";
echo password_hash("HELLO ", PASSWORD_DEFAULT) . "<BR>";
echo password_hash("HELLO ", PASSWORD_DEFAULT) . "<BR>";

//use this on login_proc.php
$myguess = "test";
echo password_verify($myguess, $password) . "does it match<br>";

//chapter 8 - exceptions and errors
ini_set("display_errors", 1);
error_reporting(E_WARNING);
try{
    //trigger_error("ERROR", E_ERROR);
    //echo $x;
    $students = file("students.txt");
    $fh = fopen("asdfasd.txt", "r"); //r means read only
    if (!mysqli_connect("localhost", "username", "badpassword", "noscheme")){
        throw new Exception("ERROR CONNECTING TO DATABASE");
    }
}
catch(Exception $ex) {
    echo "ERROR ON LINE " . $ex->getLine() . "<br>";
    echo "ERROR MESSAGE " . $ex->getMessage() . "<br>";
    error_log("ERROR ON LINE " . $ex->getLine() . "<br>");
    error_log("ERROR MESSAGE " . $ex->getMessage() . "<br>");
}
finally{ //this is optional
    //get here either way
    //close files, db connections, network connections
    fclose($students);
    fclose($fh);
}

?>