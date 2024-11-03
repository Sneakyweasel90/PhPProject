<?php
echo rand(1,6) . "<br>";
echo getrandmax() . "<br>";

function MultiplyNumber(int $x, int $y){ //type-hinting
    return $x * $y;
}

function DisplayMessage(string &$msg){  // & this is to make it by-ref the memory location
    $msg = "Poopy";//changing the value here will also change it in the calling function because it is passed by ref
    echo $msg . "<br>";
}


//pass-by-value
// function Factorial(int $n){
//     $result = 1;
//     for ($i = $n; $i > 0; $i--){
//         $result *= $i;
//     }
//     return $result;
// }

//recursive solution
//recursive function is when it calls itself
//must work towards a base case
function Factorial(int $n){
                                            //this is a ternary operator
    return ($n ==1) ? 1: $n * Factorial($n-1); //one line  ? means than   the : mean else
    // if ($n==1) return 1;
    // else {
    //     //echo $n . "<br>";
    //     return $n * Factorial($n -1);
        
    // }
}

//pass-by-value is the default 
echo MultiplyNumber(5, 10) . " product<br>";
$msg = "Hello world";
DisplayMessage($msg); //because of the & it will stay as poopy because of the by ref in the DisplayMessage function
echo $msg . " back in the main <br>";
echo Factorial(6) . "<br>";
?>