<?php
class Block_Html_Content extends Block_Core_Template
{
	function __construct()
	{
		parent::__construct();
		$this->setTemplate('html/content.phtml');
	}
}
?>