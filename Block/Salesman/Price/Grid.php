<?php
class Block_Salesman_Price_Grid extends Block_Core_Template
{
	function __construct()
	{
		parent::__construct();
		$this->setTemplate('salesman/price/grid.phtml');
	}

	public function getSalesmen()
	{
		$query = "SELECT `salesman_id`, `first_name` FROM `salesman` ORDER BY `first_name` ASC";
		$salesmen = Ccc::getModel('Salesman')->fetchAll($query);
		return $salesmen->getData();
	}

	public function getSalesmenPrice()
	{
		$id = Ccc::getModel('Core_Request')->getParams('id');
		$query = "SELECT p.`product_id`, p.`name`, p.`sku`, p.`cost`, p.`price`, p.`status`, (SELECT `salesman_price` FROM `salesman_price` WHERE `product_id` = p.`product_id` AND `salesman_id` = '{$id}') AS salesman_price, (SELECT `entity_id` FROM `salesman_price` WHERE `product_id` = p.`product_id` AND `salesman_id` = '{$id}') AS entity_id  FROM `product` AS p";
		$salesmenPrice =  Ccc::getModel('Salesman_Price')->fetchAll($query);
		return $salesmenPrice->getData();
	}
}
?>