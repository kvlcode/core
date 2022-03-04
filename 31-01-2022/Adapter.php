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

	public function insert($query)
	{
		$conn = $this -> connection();
		
		
			$run = mysqli_query($conn, $query);
			
			if ($run) {

				echo "Data Inserted"."<br>";
		
			} else {

				echo "Not Inserted"."<br>";
			
			}	

			// print_r($run);			 			 
		
	
	}


	public function fetch($query)
	{
		$conn = $this -> connection();


		$data = array();

		$run = mysqli_query($conn, $query);
			

		while($d = mysqli_fetch_assoc($run)){
				
				$data[] = $d;
		
			}	

		return $data;
		// print_r($data);	

	}


	public function update($query){
		$conn = $this-> connection();

		$run = mysqli_query($conn, $query);

		if ($run) {
			echo "Data Updated";
		} else {
			echo "Not Updated";
		}
		
	}

	public function delete($query){

		$conn = $this-> connection();

		$run = mysqli_query($conn, $query);

		if ($run) {
			echo "Deleted successfully";
		} else {
			echo "Not Deleted";
		}
		
	}

}


	//Values for inserting in table:

	
	$a1 = new Adapter();   //object of Adapater class

	$a1->connection();			//Make Connection	

	$a1->insert("insert into product values('3','mixer','1500','2','2014-01-10')");  //Insert data in table

	
	$a1->update("update product set price = '14000' where id = '1'");				//update data 

	$a1->delete("delete from product where id ='2'");				//delete data


	$fetch_data = $a1->fetch("select * from product");		//retrive data from table	
	
	echo "Fetched data from table is:"."<br>";
	print_r($fetch_data);						//print retrived data	


?>
