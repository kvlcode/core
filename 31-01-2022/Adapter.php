 <?php
 echo "<pre>";

class Adapter{

	public $host ="localhost";
	public $user = "root";
	public $password = "";
	public $db_name = "demo";



	public function connection(){

		$conn = mysqli_connect($this->host, $this->user, $this->password, $this->db_name);


		//check connection

		if($conn->connect_error){
		    die("Connection failed: ". $conn->connect_error);
		}
		else{

		    // echo "connected successfully";
		}

		return $conn;

	}

	public function insert($id,$name,$price,$quantity,$created_at)
	{
		$conn = $this -> connection();
		
			// global $conn;

			// $query = " insert into product values('1','mi','15000','5','2014-01-01') ";

			$query = " insert into product					
							values('$id','$name','$price','$quantity','$created_at') ";


			$run = mysqli_query($conn, $query);
			
			if ($run) {

				echo "Data Inserted"."<br>";
		
			} else {

				echo "Not Inserted"."<br>";
			
			}	

			// print_r($run);			 			 
		
	
	}


	public function fetch()
	{
		$conn = $this -> connection();


		$data = array();
		$query = "select * from product";

		$run = mysqli_query($conn, $query);
			

		while($d = mysqli_fetch_assoc($run)){
				
				$data[] = $d;
		
			}	

		return $data;
		// print_r($data);	

	}


	public function update(){
		$conn = $this-> connection();

		$query = "update product set price = '14000' where id = '1'";
		$run = mysqli_query($conn, $query);

		if ($run) {
			echo "Data Updated";
		} else {
			echo "Not Updated";
		}
		
	}

	public function delete(){

		$conn = $this-> connection();

		$query = "delete from product where id ='2'";

		$run = mysqli_query($conn, $query);

		if ($run) {
			echo "Deleted successfully";
		} else {
			echo "Not Deleted";
		}
		
	}



}


	//Values for inserting in table:

	$id = 3;
	$name = 'Pen';
	$price = 15;
	$quantity = 20;
	$created_at = '2010-02-01';

	
	$a1 = new Adapter();   //object of Adapater class

	$a1->connection();			//Make Connection	

	// $a1->insert($id,$name,$price,$quantity,$created_at);  //Insert data in table

	
	// $a1->update();				//update data 

	// $a1->delete();				//delete data


	// $fetch_data = $a1->fetch();		//retrive data from table	
	
	// echo "Fetched data from table is:"."<br>";
	// print_r($fetch_data);						//print retrived data	


?>
