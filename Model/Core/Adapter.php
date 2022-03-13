<?php
class Model_Core_Adapter{
	
	public $config=[
		'host'=>'localhost',
		'username'=>'root',
		'password'=>'',
		'db_name'=>'project_kaval'
	];

	private $connect=NULL;

	public function setConfig($config)
	{
		$this->config=$config;
		return $this;
	}	

	public function getConfig()
	{
		return $this->config;
	}
	
	public function connect()
	{
		$connect=mysqli_connect($this->config['host'],$this->config['username'],$this->config['password'],
			$this->config['db_name']);
		$this->setConnect($connect);
		return $connect;
	}

	public function setConnect($connect)	
	{
		$this->connect=$connect;
		return $this;
	}

	public function getConnect()
	{
		return $this->connect;
	}

	public function query($query)
	{
		if(!$this->getConnect()){
			$this->connect();
		}
		$result=$this->getConnect()->query($query);
		return $result;	
	}

	public function insert($query)
	{
		$result=$this->query($query);
		if($result){
			return $this->getConnect()->insert_id;
		}
		return $result;
	}

	public function update($query)
	{
			$result=$this->query($query);
			return $result;
	}

	public function delete($query)
	{
			$result=$this->query($query);
			return $result;
	}

	public function fetchRow($query)
	{
			$result=$this->query($query);

			if($result->num_rows){
				return $result->fetch_assoc();
			}
			return false;
	}

	public function fetchAll($query, $mode = MYSQLI_ASSOC)
	{
			$result=$this->query($query);
			if($result->num_rows > 0){
				return $result->fetch_all($mode);
			}
			return false;
	}

	public function fetchPair($query)
	{
		$result = $this->fetchAll($query,MYSQLI_NUM);
		if(!$result){
			return false;
		}
		$keys = array_column($result, "0");
		$values = array_column($result, "1");
		if (!$values) {
			$values = array_fill(0, count(keys), null);
		}
		$result = array_combine($keys, $values);
		return $result;
	}

	public function fetchOne($query)
	{
		$result = $this->fetchRow($query, MYSQLI_NUM);
		if(!$result){
			return false;
		}
		return $result;
	}
		
}

?>