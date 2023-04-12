<?php
class Block_Product_Media_Add extends Block_Core_Template
{
	function __construct()
	{
		parent::__construct();
		$this->setTemplate('product/media/add.phtml');
	}

	public function getMedia()
	{
		return $this->getData('media');
	}
}
?>