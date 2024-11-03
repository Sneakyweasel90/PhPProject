<?php

abstract class Person {
    private $height;
    private $weight;

    public function __get($property) {
        //this will return any private data member
        return $this->$property;
    }

    public function __set($property, $value) {
        $this->$property = $value;
    }

    public function __construct($h, $w) {
        $this->height = $h;  //self can be used instead as this
        $this->weight = $w;
    }

    public function toString() {
        return " PERSON HEIGHT" . $this->height . " PERSON WEIGHT " . $this->weight;
    }

    public abstract function myFunction();
    //abstract class cannot be instantiated, it can only be inherited
    //abstract functions, have no body, they must be implemented in the child class
    //abstract functions can only exists in abstract classes (not concrete classes)

}//end person class

//define( "SCHOOL", "NBCC"); //there is no $ sign when working with constants, they should be in capitals too

class Student extends Person{
    private $id;
    private $name;
    private $dob;

    public static $maxCourses = 10;
    public const SCHOOL = "NBCC";

    // public function getId() {
    //     return $this->id;
    // }
    // public function setId($id) {
    //     $this->id = $id;
    // }

    public function myFunction() {
        echo "INSIDE MY FUNCTION";
    }

    public function __get($property) {
        //this will return any private data member
        return $this->$property;
    }

    public function __set($property, $value) {
        $this->$property = $value;
    }

    //you can't overload the constructor in PHP
    public function __construct($id, $name, $dob, $height, $weight) {
        $this->id = $id;
        $this->name = $name;
        $this->dob = $dob;
        // $this->height = $height;
        // $this->weight = $weight;
        parent::__construct($height, $weight); //call the parent constructor
    }//end constructor

    // public function __construct()
    // {
    //     $arg_list = func_get_args();
    //     (isset($arg_list[0])) ? $this->id = $arg_list[0] : $this->id = 0;
    //     (isset($arg_list[1])) ? $this->name = $arg_list[1] : $this->name = "NO NAME";
    //     (isset($arg_list[2])) ? $this->dob = $arg_list[2] : $this->dob = DATE("Y/m/d");
    // }

    public function __destruct() {
        //this will get called when the object goes out of scope
        //destroy any objects like DB connection, network connections, file handlers
        echo "<br>INSIDE DESTRUCTOR<br>";
    }

    public function toString() {
        return parent::toString() . " STUDENT ID " . $this->id . " <br>NAME " . $this->name . " DOB " . $this->dob;
    }

    //final means it cannot be overwritten in any child classes
    public static final function SomeMethod() {
        echo "<br><br>INSIDE STATIC METHOD<br>";
    }
}

?>