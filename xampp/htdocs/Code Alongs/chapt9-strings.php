<?php

function p($myString){ //just to make calling the echo function easier
    echo $myString . "<br>";
}

//PREG - Perl - compatible regular expressions
//GREP - global regular expression print

$students = array("Nick", "Jimmy", "john", "jill");
$foundStudents = preg_grep("/j/i", $students); //i mean case-insensitive

print_r($foundStudents);
p("");
$myString = "Jimmy Johnson";
p(preg_match("/J/", $myString)); //this should return a boolean if it matches
p(preg_match_all("/J/", $myString)); //return int for total number of matches
$myString = "$***********9.95";
p(preg_quote($myString)); //Use this as a shortcut to escape character special characters

$myString = "Hello World";
$newString = preg_replace("/Hello/", "GoodBye", $myString); //this is to replace something inside a string
p($newString);

//split
$myString = "May~!~the~!~force~!~be~!~with~!~you.";
$myArray = preg_split("/~!~/", $myString);
print_r($myArray);
p("");

//comparison
$string1 = "HELLO";
$string2 = "hello";
//returns 1 if greater than, return 0 if equal, returns -1 if less than
p(strcasecmp($string1, $string2)); //strcasecmp is case-insensitive
//strcmp is case sensitive



//tolower
p(strtolower($string1));

//first letter uppercase
p(ucfirst($string2)); //upper case the 1st letter

//htmlentities
$myString = "<script>alert('Hello')</script><b>PHP is WOOOWOWOWOW</b>";
p($myString);
p(htmlentities($myString));

//strip off the HTML tags
p(strip_tags($myString));


//mysqli_real_escape_string($con, $mySqlStatement);
?>