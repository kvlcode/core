<?php

echo "<pre>";

// 1. get_parent_class():
echo "1. get_parent_class()"."<br>";

class Bike{

	function __construct(){

		//code
	}
}

class Hero extends Bike {

		function __construct(){

			echo "Parent class is ". get_parent_class($this); //this points current class
		}
}

$obj1 = new Hero();
$obj2 = new Bike();


echo "<br>";

//2. class_exists() : check before use it
echo "2. class_exists()"."<br>";

if (class_exists('Bike')) {
	echo "Yes class exists";
}

echo "<br>";

//3. get_class() :
echo "3. get_class()"."<br>";
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
echo "4. is_subclass_of()"."<br>";

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



echo "<br>";


// 5. get_class_methods()
echo "5. get_class_methods()"."<br>";

class myclass {

	function __construct()
	{
		return(true);
	}

	//method 1
	function fun1()
	{
		return(true);
	}


	//method 2
	function fun2()
	{
		return(true);
	}


}



$class_methods = get_class_methods('myclass');


foreach ($class_methods as $method) {
	
	echo "$method\n";

}

echo "<br>";



//6.get_declared_classes() :retrun the availabe class in current script
echo "6. get_declared_classes()"."<br>";

class A{

} 
class B{

}
class C{

}
 
print_r(get_declared_classes()); //gives all the avaialbe classes



echo "<br>";

//7.get_declared_interfaces() : return array of available all the interfaces in current script.
echo "7. get_declared_interfaces()"."<br>";

interface infc1{

}

print_r(get_declared_interfaces());


echo "<br>";

//8.interface_exists() : accept interface name as a string parameter, return true 1 if exists
echo "8. interface_exists() "."<br>";

echo interface_exists('infc1')."<br>"; // return 1
echo interface_exists('infc2')."<br>"; // no output


echo "<br>";



//9.is_a() : accept 2 parameter one is object and class name 
//if given object related with given class then return true.
echo "9. is_a()"."<br>";

class phone{

}

$p1=new phone();
echo is_a($p1,'phone')."<br>";//return 1
echo is_a($p1,'pen'); //no output


echo "<br>";

//10.method_exists() return true 1 if given method exists in class
echo "10. method_exists(object, method_name)"."<br>";

class form{
		function fill(){

		}
		function clear(){

		}
} 

$f1 =new form();

echo method_exists($f1, 'fill')."<br>"; // 1 
echo method_exists($f1, 'submit');


echo "<br>";


//11.property_exists() : accept class name property name  as argument 
echo "11. property_exists()"."<br>";

class mobile{
	public $mi;
	public $iqoo;
}
//$com=new mobile();

echo property_exists('mobile','iqoo')."<br>"; //true 1
echo property_exists('mobile', 'samsung'); //false

echo "<br>";


// 12.get_called_class(): 
echo "12. get_called_class()"."<br>";

class animal{
	 static public  function sound(){

		echo get_called_class()."<br>";
	}



}

// echo get_called_class(); //error  because outside

$a1 =new animal();
$a1 -> sound();


echo "<br>";


//13.get_class_vars() : return Returns an associative array   
echo "13. get_class_vars()"."<br>";
class var_class{

	var $name='mohan';
	var $age;
}

$var2=new var_class();

$var_info = get_class_vars(get_class($var2));

foreach ($var_info as $key => $value) {
	
	echo $key.":".$value."<br>";
}

//print_r(get_class_vars($variable_info));


echo "<br>";

//14. is_subclass_of() : accept two parameter and return true 1 if sub class is exists
//same working with interface.

echo "14. is_subclass_of(object,'classname')"."<br>";
class state{

}
class city extends state{

}

$guj =new state();
$ahm =new city();

echo is_subclass_of($guj, 'state'); //no subclass

echo is_subclass_of($ahm, 'state')."<br>";

echo "<br>";


//15. trait_exists() : return true 1 if trait exists in your code

echo "15. trait_exists('trait_name')"."<br>";

trait t1{
	function hello(){
		echo "hello"."<br>";
	}
}

class p1{
		use t1;
}
class p2{
		use t1;
}

$o1 = new p1();
$o2 = new p2();

$o1->hello();

echo trait_exists('t1')."<br>";


echo "<br>";


//16.get_declared_traits() : return array type if trait availabe in your script, no parameter required 

echo "16. get_declared_traits()"."<br>";

print_r(get_declared_traits());
 
 echo "<br>";
 //echo get_declared_traits()."<br>"; // error 


// 17.class_uses() return array type
//return the traits used by the given class.

echo "17. class_uses('class name') "."<br>";

print_r(class_uses('p1'));
print_r(class_uses('p2'));

//print_r(class_uses('p3'));// not using p3 


echo "<br>";

//18. class_implements() : return array, - parameter will be class name or object name.

echo "18. class_implements('class_name' or object_name)"."<br>";


interface if1{

}

class c1 implements if1{

}

$obj4 =new c1();

print_r(class_implements($obj4)); //c1 class implements if1 interface

echo "<br>";

print_r(class_implements('c1'));

echo "<br>";



//19. class_alias()  create the class same as class

echo "19. class_alias()"."<br>";

class magic{


}

class_alias('magic','trick');

$dyno = new magic();

$ksm =new trick();


if ($ksm) {

	echo "Yes"."<br>";
}
else{
	echo "No"."<br>";
}

echo "<br>";


//20. get_object_vars():

echo "20. get_object_vars()";

class abc {

	private $q1;
	public $q2 = 2;
	public $q3;
	static $q4;

	public function fun3(){

		var_dump(get_object_vars($this));
	}

}

$test = new abc;

var_dump(get_object_vars($test));
$test -> fun3();


?>