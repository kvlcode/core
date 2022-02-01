<?php
echo "<pre>";

//methods : get, set, reset

class product{

		public $price = 0;

		public function setPrice($p)
		{			
			$this->price = $p;
			return $this;
		}

		public function getPrice()
		{			
			return $this->price;
		}

		public function resetPrice()
		{			
			$this->price = 0;
			return $this;
		}




}

$pobj = new product();

print_r($pobj);
echo "<br>";

$pobj->setPrice(10);
echo "Price after set:"."<br>";
print_r($pobj);


$pobj->getPrice();
echo "getPrice:"."<br>";
print_r($pobj);


$pobj->resetPrice();
echo "Price after reset:"."<br>";
print_r($pobj);



?>