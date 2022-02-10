<?php
echo '<pre>';

$data = [

	['category'=>1,'attribute'=>1,'option'=>1],
	['category'=>1,'attribute'=>1,'option'=>2],
	['category'=>1,'attribute'=>2,'option'=>3],
	['category'=>1,'attribute'=>2,'option'=>4],
	['category'=>2,'attribute'=>3,'option'=>5],
	['category'=>2,'attribute'=>3,'option'=>6],
	['category'=>2,'attribute'=>4,'option'=>7],
	['category'=>2,'attribute'=>4,'option'=>8]
];


$final =[];
foreach ($data as $row) {

	if(!array_key_exists($row['category'], $final)){
		$final[$row['category']]=[];
	}

	if(!array_key_exists($row['attribute'], $final[$row['category']])){
		$final[$row['category']][$row['attribute']]=[];
	}

	$final[$row['category']][$row['attribute']][$row['option']]=$row['option'];
	
}
print_r($final);



// foreach ($data as $key => $value) {
	
// 	$c = $data[$key]['category'];
	
// 	$a = $data[$key]['attribute'];
	
// 	$o = $data[$key]['option'];
	
// 	$example[$c][$a][$o] = "$o";

	
// }

echo "<br>";

$data2 = [
	'1'=>[
		'1' => [
			'1' => 1,
			'2' => 2		
		],
		'2' => [
			'3' => 3,
			'4' => 4		
		]
	],
	'2'=>[
		'3' => [
			'5' => 5,
			'6' => 6		
		],
		'4' => [
			'7' => 7,
			'8' => 8		
		]
	],
];

echo "======================================================";
$example2 = [];

foreach ($data2 as $key => $value) {
	foreach ($data2[$key] as $key2 => $value2) {
		foreach ($data2[$key][$key2] as $key3 => $value3) {
			$example2[]=['çategory'=>$key,'attribute'=>$key2,'option'=>$key3];
		}
	}
}
print_r($example2);


// $final2=[];
// foreach ($data2 as $categoryId => $level) {
// 	$row['category']=$categoryId;
// 		array_push($final2,$row);
// 	foreach ($level as $attributeId => $level2) {
// 			$row['attribute']=$attributeId;
			
// 			foreach ($level2 as $optionId => $level3) {
// 					$row['option']=$optionId;
// 					array_push($final2,$row);
// 				}	
// 	}
// }

// print_r($final2);

// $final =[];

// foreach ($data2 as $row1) {
// 	foreach ($row1 as $row2) {
// 		foreach ($row2 as $row3) {
			
// 			$final[] = ['çategory'=>$row1,'attribute'=>$row2,'option'=>$row3];

// 		}
// 	}
// }
// print_r($final);




?>