<?php

include ("Student.php");

$s = new Student(123, "Neil", "5 Sept 1990", 60, 120); //create an instance of the object

$s->name = "Jimmy"; //call the setter

echo $s->name; //call the getter
echo "<br> ";
echo $s->toString();
echo "<br> ";
PrintDetails($s);
echo "<br> ";
$s->SCHOOL = "<br>UNB";
echo $s->SCHOOL;
echo "<br> ";
Student::SomeMethod(); // the :: is a resolution operator to access static methods

echo "<br>MAX COURSES" . Student::$maxCourses;

function PrintDetails(Student $myStudent) {
    echo "<br>".$myStudent->toString();
}

?>