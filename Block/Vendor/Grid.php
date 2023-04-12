<?php
class Block_Vendor_Grid extends Block_Core_Template
{
	function __construct()
	{
		parent::__construct();
		$this->setTemplate('vendor/grid.phtml');
	}

	public function getVendors()
	{
		$query = "SELECT * FROM `vendor` ORDER BY `first_name` DESC;";
		$vendors =  Ccc::getModel('Vendor')->fetchAll($query);
		return $vendors->getData();
	}
}
?>