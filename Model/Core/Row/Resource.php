<?php Ccc::loadClass('Model_Core_Row');
class Model_Core_Row_Resource
{
	protected $resourceName = NULL;
	protected $primaryKey = NULL;

	public function insert(array $insertData)
	{
		$columnName =[];
		$data = [];
		
     	foreach ($insertData as $column => $value) {
             $columnName[] = $column;
             $data[] = $value;
        	}

        	$fields = implode(",", $columnName);
		$fieldValues = "'".implode("','", $data)."'";
		
		$query = "INSERT INTO {$this->getResourceName()}($fields) VALUES ($fieldValues)";

        	$insertId = $this->getAdapter()->insert($query);
		return $insertId;
	}

	
	public function update(array $updateData, array $column)
	{
		$key = key($column);
		$value = $column[$key]; 
		foreach ($updateData as $columnName => $data) {
			$setArray[] = "$columnName = '$data'"; 
		}

		$setValues = implode(",", $setArray);
		$query = "UPDATE {$this->getResourceName()} SET {$setValues} WHERE {$key} = {$value}";
		print_r($query);
		echo "<br>";
		$update = $this->getAdapter()->update($query);
		return $update;

	}

	public function delete($deleteId)
	{	
		$resourceName = $this->getResourceName();
		$primaryKey = $this->getPrimaryKey();

		$query = "DELETE FROM `$resourceName` WHERE {$primaryKey} = {$deleteId}";
	
		
		$delete = $this->getAdapter()->delete($query);
		return $delete;
	} 

	public function fetchAll($query)
	{
		$allData = $this->getAdapter()->fetchAll($query);
		return $allData;
	}

	public function fetchRow($query)
	{
		
		$row = $this->getAdapter()->fetchRow($query);
		return $row;
	}

	public function setResourceName($resourceName)
	{
		$this->resourceName = $resourceName;
		return $this;
	}

	public function getResourceName()
	{
		return $this->resourceName;
	}

	public function setPrimaryKey($primaryKey)
	{
		$this->primaryKey = $primaryKey;
		return $this;
	}

	public function getPrimaryKey()
	{
		return $this->primaryKey;
	}

	public function getAdapter()
	{
		global $adapter;
		return $adapter;
	}

}