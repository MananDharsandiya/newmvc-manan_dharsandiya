<?php
class Block_Payment_Edit extends Block_Core_Template
{
	function __construct()
	{
		parent::__construct();
		$this->setTemplate('payment/edit.phtml');
	}

	public function getPayment()
	{
		return $this->getData('payment');
	}
}
?>