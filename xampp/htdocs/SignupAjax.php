<?php
include_once('connect.php');

// if (!isset($_SESSION["SESS_MEMBER_ID"])) {
	
// 	header("location:Login.php");
// }

header('Content-Type: application/json');
$inputUsername = $_GET['q'];

$sql = "SELECT `screen_name` FROM users WHERE `screen_name` = '$inputUsername'";

$result = mysqli_query($con, $sql);

//A great tool for this was to hit F12 on the SignupAjax.php page and than check the errors in the network tab / console tab

$response = [];

if ($result->num_rows > 0) {
    $response['screen_name'] = 'taken'; // Username already exists
} else {
    $response['screen_name'] = 'available'; // Username is available
}


echo json_encode($response); // Send the response back as JSON

?>
