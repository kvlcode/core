<?php
class Model_Core_Row{

	protected $data = [];
	protected $resourceClassName = NULL;

	public function getResourceClassName()
	{
		return $this->resourceClassName;
	}

	public function setResourceClassName($resourceClassName)
	{
		$this->resourceClassName = $resourceClassName;
		return $this;
	}

	public function setData(array $data)
	{
		$this->data = $data;
		return $this;
	}

	public function getData()
	{
		return $this->data;
	}

	public function resetData()
	{
		$this->data = [];
		return $this;
	}

	public function __set($key, $value)		
	{
		$this->data[$key] = $value;
		return $this;		
	}

	public function __get($key)
	{
		if (!array_key_exists($key, $this->data)) {
			return null;
		}
		return $this->data[$key];
	}

	public function __unset($key)
	{	
		if (array_key_exists($key, $this->data)) {
			
			unset($this->data[$key]);	
		}
		return null;
	}

	public function getResource()
	{
		return Ccc::getModel($this->getResourceClassName());
	}


	public function fetchAll($query)
	{
		$rows = $this->getResource()->fetchAll($query);
		if (!$rows) {
			return false;
		}
		foreach ($rows as &$row) {
			$row = (new $this())->setData($row);

		}
		return $rows;		
	}

	public function fetchRow($query)
	{
		$row = $this->getResource()->fetchRow($query);
		if (!$row) {
			return false;
		}
		$row = (new $this())->setData($row);
		return $row;
	}

	public function delete($id)
	{
		$this->getResource()->delete($id);
		return $this;
	}

	public function save($column = null)
	{
		if (!$column) {
			$column = $this->getResource()->getPrimaryKey();
		}	

		if (array_key_exists($column, $this->data)) {
	
			$id = $this->data[$column];
			$result = $this->getResource()->update($this->data, [$column => $id]);
		}
		else{
			
			$result = $this->getResource()->insert($this->data);
		}
		return $result;

	}

	public function load($id, $column = null)
	{
		if ($column == null) {
			$column = $this->getResource()->getPrimaryKey();
		}
		return $this->fetchRow("SELECT * FROM {$this->getResource()->getResourceName()} WHERE {$column} = {$id}");
	}

}