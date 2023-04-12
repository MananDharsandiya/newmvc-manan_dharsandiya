<?php
class Block_Vendor_Edit extends Block_Core_Template
{
	function __construct()
	{
		parent::__construct();
		$this->setTemplate('vendor/edit.phtml');
	}

	public function getVendor()
	{
		return $this->getData('vendor');
	}

	public function getVendorAddress()
	{
		return $this->getData('vendorAddress');
	}
}
?>