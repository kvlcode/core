<?php

echo '<pre>';
//Variables

//$1var = 3; <- Variable name start with number so, Invalid.

// echo() //int, string
// print_r() // array, objects
// var_dump()  // int, string, array, objects

$var_int = 30;
echo($var_int);
var_dump($var_int);

$var_string = "Hello";
echo($var_string);
var_dump($var_string);

$var_bool = true;
echo($var_bool);
var_dump($var_bool);

$var_arr = ['black','blue','red','orange'];
print_r($var_arr);
var_dump($var_arr);


class A{


}

$obj = new A();
print_r($obj);


echo "<br>";
// var_dump(var_dump($var_int));



$x = null;

echo($x);





?>	