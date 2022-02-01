<?php 

echo "<pre>";

// Class can contains variables, constants and methods.

class product {

	public $price = 0; 

}

$p1 = new product();

echo "p1 is :"."<br>";
print_r($p1);
echo "<br>";


$p1->price = 10;     // change by p1

echo "Updated p1 is :"."<br>";
print_r($p1);
echo "<br>";

$p2 = $p1;  // assign value of p1 into p2, it also assign data type

echo "p2 is :"."<br>";
print_r($p2);
echo "<br>";

$p2->price = 20;		//change by p2

echo "Updated p2 is :"."<br>";
print_r($p2);
echo "<br>";


echo "Value of p1 after update p2 :"."<br>";
print_r($p1);
echo "<br>";

$p3 = $p2;   
echo "p3 is :"."<br>";
print_r($p3);
echo "<br>";


$p3->price = 40;			//change by p3

echo "Updated p3 is :"."<br>";
print_r($p3);
echo "<br>";


echo "Value of p2 after update p3 :"."<br>";
print_r($p2);
echo "<br>";


echo "Value of p1 after update p3 :"."<br>";
print_r($p1);
echo "<br>";



?>