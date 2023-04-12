<?php
class Block_Core_Layout extends Block_Core_Template
{
	function __construct()
	{
		parent::__construct();
		$this->setTemplate('core/layout/3columns.phtml');
		$this->prepareChildren();
	}

	public function prepareChildren()
	{
		$header = ($this->createBlock('Html_Header'))->setLayout($this);
		$this->addChild('header', $header);
		$message = ($this->createBlock('Html_Message'))->setLayout($this);
		$this->addChild('message', $message);
		$left = ($this->createBlock('Html_Left'))->setLayout($this);
		$this->addChild('left', $left);
		$content = ($this->createBlock('Html_Content'))->setLayout($this);
		$this->addChild('content', $content);
		$right = ($this->createBlock('Html_Right'))->setLayout($this);
		$this->addChild('right', $right);
		$footer = ($this->createBlock('Html_Footer'))->setLayout($this);
		$this->addChild('footer', $footer);
	}

	public function createBlock($blockName)
	{
		$block = 'Block_'.$blockName;
		return (new $block())->setLayout($this);
	}

	public function addContent($key, $object)
	{
		return $this->getChild('content')->addChild($key, $object);
	}
}
?>