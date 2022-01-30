<?php

echo "<pre>";

// 1. get_parent_class():

class Bike{

	function __construct(){

		//code
	}
}

class Hero extends Bike {

		function __construct(){

			echo "Parent class is ". get_parent_class($this);
		}
}

$obj1 = new Hero();
$obj2 = new Bike();



echo "<br>";

//2. class_exists() : check before use it

if (class_exists('Bike')) {
	echo "Yes class exists";
}

echo "<br>";

//3. get_class() :

class Car{

	function fname(){

		echo "Name is : ". get_class($this);
		echo "<br>";
	}

}

$obj3 = new Car();  //obj

//External
	echo "Name is :" .get_class($obj3);
	echo "<br>";

//Internal
$obj3 -> fname();	


// 4. is_subclass_of():

if(is_subclass_of($obj2,'Bike')){
	echo "Yes it's a subclass of Bike";
}
else{
	echo "No, it's not a subclass of Bike";
}

echo "<br>";


if(is_subclass_of($obj1,'Bike')){
	echo "Yes it's a subclass of Bike";
}
else{
	echo "No, it's not a subclass of Bike";
}

echo "<br>";

if(is_subclass_of('Hero','Bike')){
	echo "Yes it's a subclass of Bike";
}
else{
	echo "No, it's not a subclass of Bike";
}


?>