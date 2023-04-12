<?php
class Block_Eav_Attribute_Edit extends Block_Core_Template
{
	function __construct()
	{
		parent::__construct();
		$this->setTemplate('eav/attribute/edit.phtml');
	}

	public function getEavAttribute()
	{
		return $this->getData('eavAttribute');
	}

	public function getEntityTypes()
	{
		$query = "SELECT * FROM `entity_type` ORDER BY `name` DESC;";
		$entityTypes =  Ccc::getModel('Eav_Attribute')->fetchAll($query);
		return $entityTypes->getData();
	}

	public function getEavAttributeOption()
	{
		if ($id = Ccc::getModel('Core_Request')->getParams('id')) {
			$query = "SELECT * FROM `eav_attribute_option` WHERE `attribute_id` = $id;";
			$options =  Ccc::getModel('Eav_Attribute_Option')->fetchAll($query);
			return $options;
		}
		
		return Ccc::getModel('Eav_Attribute_Option');
	}
}
?>