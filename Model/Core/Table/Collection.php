<?php
class Model_Core_Table_Collection
{
	protected $data = [];

	public function setData($data)
	{
		$this->data = array_merge($this->data, $data);
		return $this;
	}

	public function getData()
	{
		return $this->data;
	}

	public function count()
	{
		return count($this->getData());
	}

	public function getFirst()
	{
		if (array_key_exists(0, $this->getData())) {
		 	return $this->getData()[0];
		} 
		
		return null;
	}

	public function getLast()
	{
		if (array_key_exists(($this-count()-1), $this->getData())) {
		 	return $this->getData()[($this-count()-1)];
		} 
		
		return null;
	}
}
?>