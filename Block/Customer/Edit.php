<?php
class Block_Customer_Edit extends Block_Core_Template
{
	function __construct()
	{
		parent::__construct();
		$this->setTemplate('customer/edit.phtml');
	}

	public function getCustomer()
	{
		return $this->getData('customer');
	}

	public function getCustomerAddress()
	{
		return $this->getData('customerAddress');
	}
}
?>