<?php

class Controller_Core_Action
{
	protected $message = null;
	protected $request = null;
	protected $layout = null;

	public function setMessage(Model_Core_Message $message)
	{
		$this->message = $message;
		return $this;
	}

	public function getMessage()
	{
		if ($this->message) {
			return $this->message;
		}

		$message = Ccc::getModel('Core_Message');
		$this->setMessage($message);
		return $message;
	}

	public function setRequest(Model_Core_Request $request)
	{
		$this->request = $request;
		return $this;
	}

	public function getRequest()
	{
		if ($this->request) {
			return $this->request;
		}

		$request = Ccc::getModel('Core_Request');
		$this->setRequest($request);
		return $request;
	}

	public function setLayout(Block_Core_Layout $layout)
	{
		$this->layout = $layout;
		return $this;
	}

	public function getLayout()
	{
		if ($this->layout) {
			return $this->layout;
		}

		$layout = new Block_Core_layout();
		$this->setLayout($layout);
		return $layout;
	}

	public function redirect($action = null, $controller = null, $params = [], $resetParam = false)
	{
		$url = Ccc::getModel('Core_Url')->getUrl($action, $controller, $params, $resetParam);
		header("location: $url");
		exit();
	}

	public function render()
	{
		return $this->getLayout()->render();
	}

}
?>