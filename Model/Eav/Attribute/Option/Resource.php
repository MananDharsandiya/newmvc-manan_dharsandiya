<?php
class Model_Eav_Attribute_Option_Resource extends Model_Core_Table_Resource
{
	function __construct()
	{
		parent::__construct();
		$this->setTableName('Eav_Attribute_Option')->setPrimaryKey('option_id');
	}
}
?>