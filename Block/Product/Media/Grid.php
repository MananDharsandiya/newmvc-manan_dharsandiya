<?php
class Block_Product_Media_Grid extends Block_Core_Template
{
	function __construct()
	{
		parent::__construct();
		$this->setTemplate('product/media/grid.phtml');
	}

	public function getMedias()
	{
		$product_id = Ccc::getModel('Core_Request')->getParams('id');
		$query = "SELECT * FROM `product_media` WHERE `product_id` = {$product_id} ORDER BY `name` DESC;";
		$medias = Ccc::getModel('Product_Media')->fetchAll($query);
		return $medias->getData();
	}
}
?>