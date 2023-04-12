<?php
class Model_Core_Table
{
	protected $resourceClass = 'Model_Core_Table_Resource';
	protected $collectionClass = 'Model_Core_Table_Collection';
	protected $data = [];
	protected $resource = null;
	protected $collection = null;

	function __construct()
	{
		
	}

	public function setResourceClass($resourceClass)
	{
		$this->resourceClass = $resourceClass;
		return $this;
	}

	public function getResourceClass()
	{
		return $this->resourceClass;
	}

	public function setResource($resource)
	{
		$this->resource = $resource;
		return $this;
	}

	public function getResource()
	{
		if ($this->resource) {
			return $this->resource;
		}

		$resource = new $this->resourceClass();
		$this->setResource($resource);
		return $resource;
	}

	public function setCollectionClass($collectionClass)
	{
		$this->collectionClass = $collectionClass;
		return $this;
	}

	public function getCollectionClass()
	{
		return $this->collectionClass;
	}

	public function setCollection($collection)
	{
		$this->collection = $collection;
		return $this;
	}

	public function getCollection()
	{
		if ($this->collection) {
			return $this->collection;
		}

		$collection = new $this->collectionClass();
		$this->setCollection($collection);
		return $collection;
	}

	public function getTableName()
	{
		return $this->getResource()->getTableName();
	}

	public function getPrimaryKey()
	{
		return $this->getResource()->getPrimaryKey();
	}

	public function setId($id)
	{
		$this->data[$this->getResource()->getPrimaryKey()] = (int) $id;
		return $this;
	}

	public function getId()
	{
		$primaryKey = $this->getResource()->getPrimaryKey();
		return $this->$primaryKey;
	}

	public function __set($key, $value)
	{	
		$this->data[$key] = $value;
		return $this;
	}

	public function __get($key)
	{
		if (array_key_exists($key, $this->data)) {
			return $this->data[$key];
		}
		return null;
	}

	public function __unset($key)
	{
		if ($key == null) {
			$this->data = [];
		}
		if (!array_key_exists($key, $this->data)) {
			return null;
		}
		unset($this->data[$key]);
	}

	public function setData($data)
	{
		$this->data = array_merge($this->data, $data);
		return $this;
	}

	public function getData($key = null)
	{
		if ($key == null) {
			return $this->data;
		}
		if (array_key_exists($key, $this->data)) {
			return $this->data[$key];
		}
		return null;
	}

	public function addData($key, $value)
	{
		$this->data[$key] = $value;
		return $this;
	}

	public function removeData($key = null)
	{
		if ($key == null) {
			return $this->data = [];
		}
		if (!array_key_exists($key, $this->data)) {
			return null;
		}
		unset($this->data[$key]);
		return $this;
	}

	public function fetchAll($query)
	{
		$result = $this->getResource()->fetchAll($query);
		if (!$result) {
			return false;
		}
		foreach ($result as &$row) {
			 $row = (new $this)->setData($row)->setResource($this->getResource());
		}
		$collection = $this->getCollection()->setData($result);
		return $collection;
	}

	public function fetchRow($query)
	{
		$row = $this->getResource()->fetchRow($query);
		if (!$row) {
			return false;
		}
		$this->setData($row);
		return $this;
	}

	public function load($id, $column = null)
	{
		if (!$column) {
			$column = $this->getPrimaryKey();
		}

		$query = "SELECT * FROM `{$this->getTableName()}` WHERE `{$column}` = '{$id}'";
		$row = $this->getResource()->fetchRow($query);

		if (!$row) {
			return null;
		}

		$this->setData($row);
		return $this;
	}

	public function save()
	{
		if (array_key_exists($this->getPrimaryKey(), $this->getData())) {
			$id = $this->getData($this->getPrimaryKey());
			$condition = [$this->getPrimaryKey() => $id];
			$this->removeData($this->getPrimaryKey());
			$result =  $this->getResource()->setTableName($this->getTableName())->setPrimaryKey($this->getPrimaryKey())->update($this->getData(), $condition);
		}
		else {
			$id = $this->getResource()->setTableName($this->getTableName())->insert($this->getData());
		}
		
		return $this->load($id);
	}

	public function delete()
	{
		$condition = [$this->getPrimaryKey() => $this->getData($this->getPrimaryKey())];
		if (!array_values($condition)) {
			return false;
		}

		$result = $this->getResource()->setTableName($this->getTableName())->delete($condition);
		if (!$result) {
			return false;
		}

		$this->removeData();
		return true;
	}
	
}
?>