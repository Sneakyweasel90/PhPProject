<?php include("../connect.php"); ?>

<?php
//add code here to process the form and insert a new product record
if (isset($_POST["txtProdId"])){ //only run this if the form was submitted via post
    $productId = $_POST["txtProdId"];
    $category = $_POST["txtCategory"];
    $description = $_POST["txtDesc"];
    $price = $_POST["txtPrice"];
    echo $productId . " " . $category . " " . $description . " " . $price . "<br>";
    //AddRecord($con, $productId, $category, $description, $price);
    UpdateRecord($con, $productId, $category);
}
else {
    echo "CAN'T ACCESS THIS PAGE DIRECTLY";
}


//type-hinting  this will throw an exception if the type doesn't match
function AddRecord($con, $id, $category, $description, $price) {
    //insert statement
    $sql = "INSERT INTO `products`(`ID`, `Category`, `Description`, `Image`, `Price`)
    VALUES($id, '$category', '$description', '', $price)";
    echo $sql . " SQL<br>"; //for debugging / remove

    //run the sql 
    mysqli_query($con, $sql);
    if(mysqli_affected_rows($con) == 1){
        $msg = "Insert_Successful.";
    }
    else {
        $msg = "Insert_Failed.";
        
    }
    echo $msg;
    //redirect the user back to the form
    header("location:Chap27.php?message= $msg"); //This goes into the url





    //This is for timing out the success for 5 seconds
    // echo "<script>
    //         setTimeout(function(){
    //             window.location.href = 'Chap27.php';
    //         }, 5000); // 5000ms = 5 seconds
    //       </script>";

    //header("Refresh:5; url=Chap27.php");
    
}

function UpdateRecord($con, $id, $category) {
    //update statement
    $sql = "update products set Category = '$category' where ID = $id";
    echo $sql . " SQL<br>"; //for debugging / remove

    //run the sql 
    mysqli_query($con, $sql);
    if(mysqli_affected_rows($con) == 1){
        $msg = "Update_Successful.";
    }
    else {
        $msg = "Update_Failed.";
        
    }
    echo $msg;
    //redirect the user back to the form
    header("location:Chap27.php?message= $msg");
}