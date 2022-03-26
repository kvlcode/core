<?php 
Ccc::loadClass('Model_Core_View');
class Block_Core_Template extends Model_Core_View
{
	protected $children = [];
	protected $layout = null;

	public function setLayout($layout)
	{
		$this->layout = $layout;
		return $this;
	}

	public function getLayout()
	{
		return $this->layout;
	}


	public function getChildren()
	{
		return $this->children;
	}

	public function setChildren(array $children)
	{
		$this->children = $children;
		return $this;
	}

	public function getChild($key)
	{
		if(array_key_exists($key, $this->children))
		{
			return $this->children[$key];
		}
		return null;
	}

	public function addChild($object, $key = null)
	{
		if(!$key)
		{
			$key = get_Class($object);
		}
		$this->children[$key] = $object;
		$object->setLayout($this->getLayout());
		return $this;
	}
	
	public function removeChild($key)
	{
		if(array_key_exists($key, $this->children))
		{
			unset($this->children[$key]);
		}
		return $this;
	}

}