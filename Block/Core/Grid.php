<?php 
Ccc::loadClass('Block_Core_Template');
class Block_Core_Grid extends Block_Core_Template{
	protected $collection = [];
	protected $columns = [];
	protected $actions = [];
	
	public function __construct()
	{
		$this->setTemplate('view/core/grid.php');
		$this->prepareColumns();
		$this->prepareCollections();
		$this->prepareActions();
	}

	public function getColumnValue($collection, $key, $value)
	{
		if ($key == 'status') {
			return $collection->getStatus($value);
		}
		return $value;
	}

	public function prepareCollections()
	{
		return $this;
	}

	public function prepareColumns()
	{
		return $this;
	}

	public function prepareActions()
	{
		return $this;
	}
	
	public function getCollection()
	{
		return $this->collection;
	}

	public function setCollection($collection)
	{
		$this->collection = $collection;
		return $this;
	}

	public function setColumns(array $columns)
	{
		$this->columns = $columns;
		return $this;
	}

	public function getColumns()
	{
		return $this->columns;
	}

	public function addColumn($column, $key = null)
	{
		$this->columns[$key] = $column;
		return $this;
	}

	public function removeColumn($key)
	{
		if (array_key_exists($key, $this->columns)) {
			unset($this->columns[$key]);
		}
		return $this;
	}

	public function resetColumn()
	{
		$this->columns = [];
		return $this;
	}

	public function getColumn($key)
	{
		if (array_key_exists($key, $this->columns)) {
			return $this->columns[$key];
		}
		return null;
	}

	public function setActions(array $actions)
	{
		$this->actions = $actions;
		return $this;
	}

	public function getActions()
	{
		return $this->actions;
	}

	public function addAction($action, $key = null)
	{
		$this->actions[$key] = $action;
		return $this;
	}

	public function removeAction($key)
	{
		if (array_key_exists($key, $this->actions)) {
			unset($this->actions[$key]);
		}
		return $this;
	}

	public function getAction($key)
	{
		if (array_key_exists($key, $this->actions)) {
			return $this->actions[$key];
		}
		return null;
	}

	public function resetAction()
	{
		$this->actions = [];
		return $this;
	}

}
