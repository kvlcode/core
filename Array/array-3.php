<?php
echo '<pre>';


$data = [

	['category'=>1,'categoryname'=>'c1','attribute'=>1,'attributename'=>'a1','option'=>1,'optionname'=>'o1'],
	['category'=>1,'categoryname'=>'c1','attribute'=>1,'attributename'=>'a1','option'=>2,'optionname'=>'o2'],
	['category'=>1,'categoryname'=>'c1','attribute'=>2,'attributename'=>'a2','option'=>3,'optionname'=>'o3'],
	['category'=>1,'categoryname'=>'c1','attribute'=>2,'attributename'=>'a2','option'=>4,'optionname'=>'o4'],
	['category'=>2,'categoryname'=>'c2','attribute'=>3,'attributename'=>'a3','option'=>5,'optionname'=>'o5'],
	['category'=>2,'categoryname'=>'c2','attribute'=>3,'attributename'=>'a3','option'=>6,'optionname'=>'o6'],
	['category'=>2,'categoryname'=>'c2','attribute'=>4,'attributename'=>'a4','option'=>7,'optionname'=>'o7'],
	['category'=>2,'categoryname'=>'c2','attribute'=>4,'attributename'=>'a4','option'=>8,'optionname'=>'o8']

];


$final['category'] =[] ;

foreach ($data as $row) {
	$category = $row['category'];	 		//1,1,1,1,2,2,2,2
	$categoryName = $row['categoryname'];	//c1,c1,c1,c1,c2,c2,c2,c2,
	$attribute = $row['attribute'];			//1,1,2,2,3,3,4,4
	$attributeName = $row['attributename'];	//a1,a1,a2,a2,a3,a3,a4,a4
	$option = $row['option'];				//1,2,3,4,5,6,7,8
	$optionName = $row['optionname'];		//o1,o2,o3,o4,o5,o6,o7,o8
		
	if (!array_key_exists($category, $final['category'])) {
			$final['category'][$category] =[];
	}	

	if(!array_key_exists('name', $final['category'][$category])){
			$final['category'][$category] = ['name' => $categoryName];
			$final['category'][$category]['attribute']=[];

	}


	if (!array_key_exists($attribute, $final['category'][$category]['attribute'])) {
		$final['category'][$category]['attribute'][$attribute] = [];
		
	}


	if (!array_key_exists('name', $final['category'][$category]['attribute'][$attribute])) {
		$final['category'][$category]['attribute'][$attribute] = ['name' => $attributeName];
		$final['category'][$category]['attribute'][$attribute]['option'] = [];
		
	}

	if (!array_key_exists($option, $final['category'][$category]['attribute'][$attribute]['option'])) {
		$final['category'][$category]['attribute'][$attribute]['option'][$option] = [];

	}


	if(!array_key_exists('name', $final['category'][$category]['attribute'][$attribute]['option'])) {
		$final['category'][$category]['attribute'][$attribute]['option'][$option] = ['name'=>$optionName];
		
	}
	
		// $final['category'][$category]['attribute'][$attribute]['option'][$option] = ['name'=>$optionName];
				
}

print_r($final);

// foreach ($data as $key => $value) {
// 	$category = $data[$key]['category'];	 		//1,1,1,1,2,2,2,2
// 	$categoryName = $data[$key]['categoryname'];	//c1,c1,c1,c1,c2,c2,c2,c2,
// 	$attribute = $data[$key]['attribute'];			//1,1,2,2,3,3,4,4
// 	$attributeName = $data[$key]['attributename'];	//a1,a1,a2,a2,a3,a3,a4,a4
// 	$option = $data[$key]['option'];				//1,2,3,4,5,6,7,8
// 	$optionName = $data[$key]['optionname'];		//o1,o2,o3,o4,o5,o6,o7,o8
		
// 	if (!array_key_exists($category, $data)) {
// 			$final['category'] =[];
// 	}	

// 	if(!array_key_exists($categoryName, $final)){
// 			$final['category'][$category] = ['name' => $categoryName];

// 	}


// 	if (!array_key_exists($attribute, $final)) {
// 		$final['category'][$category]['attribute'] = [];
		
// 	}

// 	if (!array_key_exists($attribute, $final)) {
// 		$final['category'][$category]['attribute'][$attribute] = ['name' => $attributeName];
		
// 	}

	// if(!array_key_exists($optionName, $final)) {
	// 	$final['category'][$category]['attribute'][$attribute]['option'][$option] = ['name'=>$optionName];
		
	// }
	
		
		// $final['category'][$category]['attribute'][$attribute]['option'][$option] = ['name'=>$optionName];

			
					
// }



$data2 = [
	'category'=> [
		'1'=>[
			'name' => 'c1',
			'attribute'=>[
				'1' => [
					'name'=>'a1',
					'option' => [
						'1'=>[
							'name' => 'o1'
						],
						'2'=>[
							'name' => 'o2'
						]
					]
				],
				'2' => [
					'name'=>'a2',
					'option' => [
						'3'=>[
							'name' => 'o3'
						],
						'4'=>[
							'name' => 'o4'
						]
					]
				]
			]
		],
		'2'=>[
			'name' => 'c2',
			'attribute'=>[
				'3' => [
					'name'=>'a3',
					'option' => [
						'5'=>[
							'name' => 'o5'
						],
						'6'=>[
							'name' => 'o6'
						]
					]
				],
				'4' => [
					'name'=>'a4',
					'option' => [
						'7'=>[
							'name' => 'o7'
						],
						'8'=>[
							'name' => 'o8'
						]
					]
				]
			]
		]
	]
];



echo '<pre>';

$final2 = [];
foreach($data2['category'] as $categoryId => $level1){

	$row['category'] = $categoryId;
	$row['categoryname'] = $data2['category'][$categoryId]['name'];

	foreach($level1['attribute'] as $attributeId => $level2){
		
		$row['attribute'] = $attributeId;
		$row['attributename'] = $data2['category'][$categoryId]['attribute'][$attributeId]['name'];
		
		foreach ($level2['option'] as $optionId => $level3) {
			$row['option'] = $optionId;
			$row['optionname'] = $data2['category'][$categoryId]['attribute'][$attributeId]['option'][$optionId]['name'];
			array_push($final2,$row);
		}
	}
} 

print_r($final2);


/*
foreach ($data as $category => $level1) {

	$row['category'] = $category;

	foreach ($level1 as $categoryId => $level2) {
		$row['categoryId'] = $categoryId;

		foreach ($level2 as $attributeId => $level3) {
			$row['attribute'] = $attributeId;

			foreach ($level3 as $attributeName => $level4) {
				$row['attributeName'] = $attributeName;
				
				foreach ($level4 as $optionId => $level5) {
							$row['option'] = $optionId;

							foreach ($level5 as $optionName => $level6) {
								$row['optionName'] = $optionName;
							
								array_push($final2, $row);

							}
						}
				

			}
		}
	}
}
*/


?>