<?php

class Model_Core_Table
{
	protected $tableName = NULL;
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
        $fieldValues = implode("','", $data); 
		$fieldValues = "'".$fieldValues."'";

		$tableName = $this->getTableName();

		$query = "INSERT INTO `$tableName`($fields) VALUES ($fieldValues)";
        // $insertId = $this->getAdapter()->insert($query);
        global $adapter;
        $insertId =$adapter->insert($query);
		return $insertId;
	}

	
	public function update(array $updateData, array $hiddenId)
	{
		$key = key($hiddenId);
		$value = $hiddenId[$key];
	
		foreach ($updateData as $columnName => $data) {
			$setValues[] = "$columnName = '$data'"; 
		}

		$setString = implode(",", $setValues);
		$tableName = $this->getTableName();

		$query = "UPDATE `$tableName` SET $setString WHERE $key = $value";
		print_r($query);
		global $adapter;
		$update = $adapter->update($query);
		return $update;

	}

	public function delete( array $deleteData)
	{	
		$key = key($deleteData);
		$value = $deleteData[$key];
		$tableName = $this->getTableName();
		$query = "DELETE FROM `$tableName` WHERE $key = $value ";
		// $delete = $this->getAdapter()->delete($query);
		global $adapter;
		$delete = $adapter->delete($query);
		return $delete;
	}

	public function fetchRow(array $rowData)
	{
		$columnName = key($rowData);
        $value = $rowData[$columnName];
		$tableName = $this->getTableName();
		global $adapter;
		$query = "SELECT * FROM `$tableName` WHERE $columnName = $value";
		$row = $adapter->fetchRow($query);
		return $row;
	}

	public function fetchAll()
	{
		$tableName = $this->getTableName();
		$query = "SELECT * FROM `$tableName`";
		// $fetch = $this->getAdapter()->fetchAll($query)
		global $adapter;
		$fetch = $adapter->fetchAll($query);
		return $fetch;
	}

	public function setTableName($tableName)
	{
		$this->tableName = $tableName;
		return $this;
	}

	public function getTableName()
	{
		return $this->tableName;
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
}

?>