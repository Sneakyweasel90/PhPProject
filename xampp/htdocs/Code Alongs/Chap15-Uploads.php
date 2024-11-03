<?php

if (isset($_GET["msg"])){
    echo "<script> alert('" . $_GET["msg"] . "')</script>";
}

?>


<html>
<head>
<title>Chapter 15-File uploading</title>
<body>
<form action="Chap15_proc.php" method="post"  enctype="multipart/form-data"> <!--to encrypt you add the enctype-->
    Please select your image (must be under 5MB):
    <input type="file" name="photo" required="required"><br> <!--From test to file for type-->
    <input type="submit" name="submit" value="UPLOAD">
</form>
</body>
</html>