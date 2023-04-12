<?php
class Model_Category extends Model_Core_Table
{
	const STATUS_ACTIVE = 1;
	const STATUS_ACTIVE_LBL = 'Active';
	const STATUS_INACTIVE = 2;
	const STATUS_INACTIVE_LBL = 'Inactive';
	const STATUS_DEFAULT = 2;

	function __construct()
	{
		parent::__construct();
		$this->setResourceClass('Model_Category_Resource');
		$this->setCollectionClass('Model_Category_Collection');
	}

	public function getStatusOptions()
	{
		return [
			self::STATUS_ACTIVE => self::STATUS_ACTIVE_LBL,
			self::STATUS_INACTIVE => self::STATUS_INACTIVE_LBL
		];
	}

	public function getStatusText()
	{
		$statues = $this->getStatusOptions();
		if (array_key_exists($this->status, $statues)) {
			return $statues[$this->status];
		}

		return $statues[self::STATUS_DEFAULT];
	}

	public function getStatus()
	{
		if ($this->status) {
			return $this->status;
		}

		return self::STATUS_DEFAULT;
	}

	public function getParentCategories()
	{
		$query = "SELECT `category_id`, `path` FROM `category` ORDER BY `path` ASC";
		$categories = $this->getResource()->getAdapter()->fetchPairs($query);
		return $categories;
	}

	public function updatePath()
	{
		if (!$this->getId()) {
			return false;
		}

		$oldPath = $this->path;
		$parent = Ccc::getModel('Category')->load($this->parent_id);
		if (!$parent) {
			$this->path = $this->category_id;
		}
		else {
			$this->path = $parent->path . '/' . $this->category_id;
		}

		$this->save();
		$query = "UPDATE `category` SET `path` = REPLACE(`path`, '{$oldPath}/', '{$this->path}/') WHERE `path` LIKE '{$oldPath}/%' ORDER BY `path` ASC";
		$this->getResource()->getAdapter()->update($query);
		
		return $this;
	}

	public function getPathCategory($categoryId)
	{
		if ($categoryId == 1) {
			return 'Root';
		}

		$category = Ccc::getModel('Category');

		$query = "SELECT `category_id`, `name` FROM `category` ORDER BY `path` ASC";
		$categories = $category->getResource()->getAdapter()->fetchPairs($query);

		$query = "SELECT `category_id`, `path` FROM `category` WHERE `parent_id` > 0 ORDER BY `path` ASC";
		$pathCategories = $category->getResource()->getAdapter()->fetchPairs($query);


		foreach ($pathCategories as $category_id => $path) {
			$pathString = explode('/', $path);
			$final = [];
			foreach ($pathString as $key => $category_id) {
				$final[$key] = $categories[$category_id];
			}

			unset($final[0]);
			$categoryName[$category_id] = implode(' > ', $final);
		}

		return $categoryName[$categoryId];
	}

}
?>