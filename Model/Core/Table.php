<?php Ccc::loadClass('Model_Core_Table_Row');
class Model_Core_Table
{
	protected $tableName = NULL;
	protected $primaryKey = NULL;
	protected $row = NULL;
	protected $rowClassName = NULL;

	public function setRowClassName($rowClassName)
	{
		$this->rowClassName = $rowClassName;
		return $this;
	}

	public function getRowClassName()
	{
		return $this->rowClassName;
	}	

	public function getRow()
	{

		return Ccc::getModel($this->getRowClassName());
	}

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
		
		$query = "INSERT INTO {$tableName}($fields) VALUES ($fieldValues)";
        	global $adapter;
        	$insertId =$adapter->insert($query);
		return $insertId;
	}

	
	public function update(array $updateData, $hiddenId)
	{
		
		foreach ($updateData as $columnName => $data) {
			$setValues[] = "$columnName = '$data'"; 
		}

		$setString = implode(",", $setValues);
		$tableName = $this->getTableName();
		$primaryKey = $this->getPrimaryKey();

		$query = "UPDATE `$tableName` SET $setString WHERE {$primaryKey} = {$hiddenId}";
		global $adapter;
		$update = $adapter->update($query);
		return $update;

	}

	public function delete($deleteId)
	{	
		$tableName = $this->getTableName();
		$primaryKey = $this->getPrimaryKey();

		$query = "DELETE FROM `$tableName` WHERE {$primaryKey} = {$deleteId}";
	
		global $adapter;
		$delete = $adapter->delete($query);
		return $delete;
	} 

	public function fetchAll($query)
	{
		global $adapter;
		$allData = $adapter->fetchAll($query);
		return $allData;
	}

	public function fetchRow($query)
	{
		global $adapter;
		$row = $adapter->fetchRow($query);
		return $row;
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

	public function load($id)
	{
		$data = $this->fetchRow("SELECT * FROM {$this->getTableName()} WHERE {$this->getPrimaryKey()} = {$id}");
		if (!$data) {
			return false;
		}
	
		$row = $this->getRow();
		$row->setData($data);
		return $row;
	}


}

?>