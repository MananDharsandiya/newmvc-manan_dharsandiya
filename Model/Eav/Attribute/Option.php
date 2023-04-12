<?php
class Model_Eav_Attribute_Option extends Model_Core_Table
{
	const STATUS_ACTIVE = 1;
	const STATUS_ACTIVE_LBL = 'Active';
	const STATUS_INACTIVE = 2;
	const STATUS_INACTIVE_LBL = 'Inactive';
	const STATUS_DEFAULT = 2;

	function __construct()
	{
		parent::__construct();
		$this->setResourceClass('Model_Eav_Attribute_Option_Resource');
		$this->setCollectionClass('Model_Eav_Attribute_Option_Collection');
	}
}
?>