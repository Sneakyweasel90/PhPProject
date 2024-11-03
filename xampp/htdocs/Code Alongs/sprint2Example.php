<!doctype html>
<?php include("../connect.php"); ?>
<html lang="en">
    <head>
        <title>Display Some Products</title>
    </head>
    <body>
        <?php 
            GetProducts($con); //get $con from the connect.php page

            $sql = "select * from products";
            //run the sql
            $rsProd = mysqli_query($con, $sql) or die();
            while($rowProd = mysqli_fetch_array($rsProd)){
                $desc = $rowProd["Description"];
                $id = $rowProd["ID"];
                echo "<a href='order_proc.php?prod_id=$id'> Order Product $desc</a><br>";
            }
        ?>    
    </body>
</html>
<?php 
function GetProducts($con) {
    //select statement to get products and loop through them
    
}