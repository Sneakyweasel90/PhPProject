<?php 
//insert the user's data into the users table of the DB
//if everything is successful, redirect them to the login page.
//if there is an error, redirect back to the signup page with a friendly message

 include ("connect.php");
 include ("User.php");

 session_start();
?>

<?php 
if (isset($_POST["firstname"])) {
    $firstName = $_POST["firstname"];
    $lastName = $_POST["lastname"];
    $email = $_POST["email"];
    $userName = $_POST["username"];
    $password = $_POST["password"];
    $confirm = $_POST["confirm"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $province = $_POST["province"];
    $postalCode = $_POST["postalCode"];
    $url = $_POST["url"];
    $desc = $_POST["desc"];
    $location = $_POST["location"];

    

    //$hash_password = password_hash($password, PASSWORD_DEFAULT); //create the hash password

    //call the hash_password and then send it into the function
    //AddUser($con, $firstName, $lastName, $userName, $hash_password, $address, $province, $postalCode, $phone, $email, $url, $desc, $location);

    $user = new User($userName, $password, $firstName, $lastName, $address, $province, $postalCode, $contactNo, $email, $profImage, $location, $desc, $url);
    
    $user->AddUser($con);
}
else{
    echo "CAN'T ACCESS THIS PAGE DIRECTLY";
}



?>