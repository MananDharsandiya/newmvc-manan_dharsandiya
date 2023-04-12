<?php
class Model_Salesman_Price extends Model_Core_Table
{
	function __construct()
	{
		parent::__construct();
		$this->setResourceClass('Model_Salesman_Price_Resource');
		$this->setCollectionClass('Model_Salesman_Price_Collection');
	}
}
?>