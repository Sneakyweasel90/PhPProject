<!DOCTYPE html>
<?php include("../connect.php")?> <!-- This is to have the connection -->
<html>
    <head>
        <title>MY FIRST PAGE</title>
        <script></script>
    </head>
    <body>
        <?php
            //all vars begin with $
            $myName = "Neil"; //string
            $myNum = 10; //int
            echo $myName . "<br>"; //the period . is used to concatenation
            print("The number is " . $myNum++ . "<br>"); //post fix this will apply the number and then add the extra number after the fact
            //variable names can't begin with a number or special character
            $Password = "whatever";
            printf("the number is %d<br>", $myName);
            echo "She said 'Hello' to me<br>";

            //if statements
            if ($myNum === 11){
                echo "EQUAL<br>";
            }
            else {
                echo "NOT EQUAL <br>";
            }
            if ($myNum <=> 11){ //<=> spaceship operator
                echo "SPACESHIP EQUAL<br>";
            }
            else {
                echo "SPACESHIP NOT EQUAL<br>";
            }
            //spaceship operator returns a 0 if the 2 values are equal
            //returns 1 if greater than and return a -1 if less than

            $value = (bool)false; //explicit cast
            echo "value = " . $value . "<br>";

            //implicit cast --- This is called type-juggling
            echo "value of x and y is " . ("10" + "10") . "<br>";

            $value = 0755; //octal
            $value = 0xabc; //hexadecimal
            

            //arrays (Chapter 5 is all about arrays)
            $names[0] = "Jeff";
            $names[1] = "Mark";

            for($i = 0; $i < count($names); $i++){
                echo $names[$i] . "<br>";
                if ($names[$i] == "Jeff"){
                    break; //exit loop
                }
            }

            //by ref variables
            $y = &$myName; //points to a memory address, if myName changse, y also changes
            $myName = "Jimmy";
            echo $y . " BYREF<br>";

            //while loop
            while ($i < 10) {  
                $i++; //don't for this line
                if ($i == 5) {continue;} //ski[ this iteration of the loop and continue]
                echo pow($i, 2) . "<br>";
            }

            //do-while
            do {
                echo pow ($i, 3) . "<br>";
                $i++;
            }
            while($i<10);




            //select from the products table in the productsdemo schema
            $id = 9;
            $sql = "select * from products where id = $id";
            if($result = mysqli_query($con, $sql)){
                while ($row = mysqli_fetch_array($result)){
                    echo $row["ID"] . "  " . $row["Category"] . " " . $row["Description"] . "<br>";
                };//end while
            }//end if

        ?>
    
            <p>Your name is <?=$myName?></p>
    </body>
</html>