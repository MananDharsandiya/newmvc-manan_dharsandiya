<?php
class Block_Product_Edit extends Block_Core_Template
{
	function __construct()
	{
		parent::__construct();
		$this->setTemplate('product/edit.phtml');
	}

	public function getProduct()
	{
		return $this->getData('product');
	}
}
?>