<?php

echo "<pre>";

//Conditions

//true => 
//false => null, 0, '', [], !true, false, '0'

$x = null;

if ($x) {
	echo "Right";
}
else{
	echo "Wrong";
}



//if

$color = 'red';

if ($color == 'red') {
	echo 'color is red';
}

echo '<br>';





//if else

$a = 5;
$b = 10;

if ($a < $b) {

	echo $b." is greater than ".$a;
} 
else {

	echo $b." is not greater than ".$a; 
}

echo '<br>';





//if else if

$x = 15;

if($x < 10){

	echo "Number is less than 10 ";
}
elseif ($x >= 10 && $x <= 20) {

	echo "Number is between 10 & 20 ";
}
else{

	echo "Number is greater than 20 ";

}

echo '<br>';






//Switch

$fruits = "Mango";

switch ($fruits) {
	
case 'Apple':
	echo "Apple is Selected";
	break;

case 'Pineapple':
	echo "Pineapple is Selected";
	break;

case 'Mango':
	echo "Mango is Selected";
	break;

case 'Orange':
	echo "Orange is Selected";
	break;

default:
		echo "No fruit is Selected";
		break;

}




?>