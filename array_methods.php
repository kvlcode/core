<?php

echo "<pre>";

$colors = array('black','blue','red','orange');

$product = array(

	"id" 		=> 123,
	"name" 		=> 'cap',
	"price" 	=> 100,
	"quantity" 	=> 5,

);

// 1. array_values() : return all the values of an array

print_r(array_values($colors));
//print_r(array_values($product));


echo "<br>";


// 2. array_keys() : return array of all the keys in array

print_r(array_keys($product));


echo "<br>";


// 3. array_combine($arr1, $arr2) : Use elements of one array as key and elements of second array as value 

$id = [1,2,3,4,5];
$name =['Krsna', 'Stan', 'Russ', 'Bob', 'Raj'];

print_r(array_combine($id, $name));


echo "<br>";


// 4. array_merge($arr1, $arr2) :  

print_r(array_merge($id, $name));


echo "<br>";


// 5. array_change_key_case() : return an array with its keys lower or upper case, by default it gives lower case.

print_r(array_change_key_case($product, CASE_UPPER));


echo "<br>";


// 6. array_chunk() : returns a multidimensional numerically indexed array. default is false which will reindex the chunk numerically

print_r(array_chunk($colors, 2));
print_r(array_chunk($colors, 2, true));


echo "<br>";



// 7. array_column() : return an array of values representing a single column from the input array.

//multi dimentional array
$students = array(

		array(

			"id" 	=> 1,
			"name" 	=> "Raj",
			"marks"	=> 70

		),
		array(

			"id" 	=> 2,
			"name" 	=> "Krsna",
			"marks"	=> 100

		),
		array(

			"id" 	=> 3,
			"name" 	=> "Vivek",
			"marks"	=> 80

		),

);



print_r(array_column($students, 'name'));


echo "<br>";


// 8. array_count_values() : returns an associative array of values from array as key and their count as value

$demo = array(
	1 =>'bike',
	2 => 'car', 
	3 =>'bicycle', 
	4 =>'car'
);
$demo2 = array(
	1 =>'truck',
	2 =>'bike', 
	3 =>'car'
);
print_r(array_count_values($demo));


echo "<br>";


// 9. array_diff() : 
print_r(array_diff($demo, $demo2));


echo "<br>";


// 10. array_diff_key() :
print_r(array_diff_key($demo, $demo2));


echo "<br>";


//11. array_fill() : return filled array

// print_r($demo = array_fill(5, 2, 'truck'));
print_r($demo3 = array_fill(-2, 3, 'FilledValue'));


echo "<br>";


//12. array_fill_keys() : 

print_r(array_fill_keys($colors, 'color'));


echo "<br>";



// 13. array_flip() :

print_r(array_flip($demo));


echo "<br>";


//14.  array_intersect() :

print_r(array_intersect($demo, $demo2));


echo "<br>";



//15. array_key_exists() : returns true if the given key is set in the array.

print_r(array_key_exists(1, $demo));


echo "<br>";


// 16. array_key_first() : returns first key of an array, if empty then returns null

print_r("First key:".array_key_first($product));


echo "<br>";


//17. array_key_last():

print_r("Last key:".array_key_last($product));


echo "<br>";

/*18. array_replace() : replaces the values of array with 
values having the same keys in each of the following 
arrays*/

$r1 = array("bike", "train", "bus");
$r2 = array(0 =>"bicycle", 3 =>"plane");

print_r(array_replace($r1, $r2));


echo "<br>";


//19. array_search() :

print_r(array_search('bicycle', $demo));


echo "<br>";


//20. array_sum() : return sum of array as int or float otherwise empty array

$arr1 = array(1,2,3,4);
print_r("Sum is: ".array_sum($arr1));



echo "<br>";



//21. array_reverse():

print_r(array_reverse($arr1));
print_r(array_reverse($arr1, true));


?>