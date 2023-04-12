<?php
class Block_Category_Grid extends Block_Core_Template
{
	function __construct()
	{
		parent::__construct();
		$this->setTemplate('category/grid.phtml');
	}

	public function getCategories()
	{
		$query = "SELECT * FROM `category` WHERE `parent_id` > 0 ORDER BY `path` ASC;";
		$categories = Ccc::getModel('Category')->fetchAll($query);
		return $categories->getData();
	}
}
?>