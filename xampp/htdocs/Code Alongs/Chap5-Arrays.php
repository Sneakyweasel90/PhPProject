<?php 
// Array
$numbers[0] = 5;
$numbers[1] = 8;
$numbers[2] = 3;

$numbers = [9 => 5, 88 => 8, 34 => 3];
$cities = ["Fredericton" => 60000, "Saint John" => 70000, "Moncton" => 80000];

//2-d array
$student = array("Jimmy" => array(99,88,77),
                "John" => array(55,60,70),
                "Sarah" => array(70,80,90));
echo count($student) . " number of elements in out array<br>";

print_r($student);//print out the array (good for debugging)
echo "<br>";
foreach($student as $s) {
    echo $s[0] . " " . $s[1] . " " . $s[2] . "<br>";
}
print_r(array_reverse($numbers));
echo "<br>";
print_r(array_flip($numbers));
echo "<br>";
array_push($numbers, 50);//add to the end of the array
array_pop($numbers);//remove the last element of the array
array_unshift($numbers, 123); //add to the beginning of the array
array_shift(($numbers));//remove from an array
print_r($numbers);
echo "<br>";
echo "<br>";


//open the file
$students = file("students.txt");
foreach ($students as $s){
    echo $s . "<br>";
    list($name, $grade1, $grade2, $grade3) = explode("|", $s);//gets rid of the |
    echo $name . " " . $grade1 . " " . $grade2 . " " . $grade3 . "<br>";
}
echo"<br>";
//search
echo(in_array(10, $numbers)) ? "FOUND" : "NOT FOUND";
echo"<br>";

//sort
sort($numbers);
print_r($numbers);

echo"<br>";
$words = array("test1", "test2", "Test10", "test22");
natcasesort($words); //case-insensitive natural sort
print_r($words);
echo"<br>";

//merge array
$mergedArray = array_merge($numbers, $words);
print_r($mergedArray);
?>