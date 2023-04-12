<?php
class Block_Shipping_Edit extends Block_Core_Template
{
	function __construct()
	{
		parent::__construct();
		$this->setTemplate('shipping/edit.phtml');
	}

	public function getShipping()
	{
		return $this->getData('shipping');
	}
}
?>