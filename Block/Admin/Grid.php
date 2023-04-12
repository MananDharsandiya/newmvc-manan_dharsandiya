<?php
class Block_Admin_Grid extends Block_Core_Template
{
	function __construct()
	{
		parent::__construct();
		$this->setTemplate('admin/grid.phtml');
	}

	public function getAdmins()
	{
		$query = "SELECT * FROM `admin` ORDER BY `name` DESC;";
		$admins = Ccc::getModel('Admin')->fetchAll($query);
		return $admins->getData();
	}
}
?>