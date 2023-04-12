<?php
class Model_Core_Request 
{
	public function getPost($key=null, $value=null)
	{
		if ($key == null) {
			return $_POST;
		}

		if (array_key_exists($key, $_POST)) {
			return $_POST[$key];
		}

		return $value;
	}

	public function isPost()
	{
		if ($_SERVER['REQUEST_METHOD'] != "POST") {
			return false;
		}

		return true;
	}

	public function getParams($key=null, $value=null)
	{
		if ($key == null) {
			return $_GET;
		}

		if (array_key_exists($key, $_GET)) {
			return $_GET[$key];
		}

		return $value;
	}

	public function getActionName()
	{
		return $this->getParams('a', 'grid');
	}

	public function getControllerName()
	{
		return $this->getParams('c', 'product');
	}
	
}
?>