<?php
include("connect.php");

if (isset($_POST['username'])) {
    $username = $_POST['username'];

    // Check if the username already exists
    $result = mysqli_query($con, "SELECT * FROM `users` WHERE `screen_name` = '$username'");

    if (mysqli_num_rows($result) > 0) {
        echo json_encode(array('status' => 'taken'));
    } else {
        echo json_encode(array('status' => 'available'));
    }
} else {
    echo json_encode(array('status' => 'error'));
}
?>
