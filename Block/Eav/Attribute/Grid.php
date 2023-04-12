<?php
class Block_Eav_Attribute_Grid extends Block_Core_Template
{
	function __construct()
	{
		parent::__construct();
		$this->setTemplate('eav/attribute/grid.phtml');
	}

	public function getEavAttributes()
	{
		$query = "SELECT * FROM `eav_attribute` ORDER BY `name` DESC";
		$eavAttributes =  Ccc::getModel('Eav_Attribute')->fetchAll($query);
		return $eavAttributes->getData();
	}
}
?>