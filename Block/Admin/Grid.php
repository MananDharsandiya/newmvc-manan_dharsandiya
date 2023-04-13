<?php

class Block_Admin_Grid extends Block_Core_Grid
{

	function __construct()
	{
		parent::__construct();
		$this->setTitle('MANAGE ADMIN METHOD');
	} 

	protected function _prepareColumns()
	{
		$this->addColumn('admin_id', [
			'title'=>'Admin Id'
		]);		
		$this->addColumn('name', [
			'title'=>'Name'
		]);		
		$this->addColumn('status', [
			'title'=>'Status'
		]);		
		$this->addColumn('created_at', [
			'title'=>'Created At'
		]);

		return parent::_prepareColumns();
	}


	protected function _prepareActions()
	{
		$this->addColumn('edit', [
			'title' => 'Edit',
			'method' => 'getEditUrl'
		]);		
		$this->addColumn('delete', [
			'title' => 'Delete',
			'method' => 'getDeleteUrl'
		]);	

		return parent::_prepareActions();	
	}


	protected function _prepareButtons()
	{
		$this->addButton('admin_id', [
			'title' => 'ADD ADMIN',
			'url' => $this->getUrl('add')
		]);

		return parent::_prepareButtons();		
	}


	public function getAdmins()
	{
		$query = "SELECT * FROM `admin`";
		$admins = Ccc::getModel('Admin')->fetchAll($query);
		return $admins->getData();
	}
}
?>