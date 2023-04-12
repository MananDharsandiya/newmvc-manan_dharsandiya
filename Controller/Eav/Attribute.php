<?php
class Controller_Eav_Attribute extends Controller_Core_Action
{
	public function gridAction()
	{
		try {
			$layout = $this->getLayout();
			$layout->addContent('grid', $layout->createBlock('Eav_Attribute_Grid'));
			$layout->render();
		} catch (Exception $e) {

		}
	}

	public function addAction()
	{
		try {
			$layout = $this->getLayout();
			$layout->addContent('add', $layout->createBlock('Eav_Attribute_Edit')->setData(['eavAttribute' => Ccc::getModel('Eav_Attribute')]));
			$layout->render();
		} catch (Exception $e) {
			
		}
	}

	public function editAction()
	{
		try {
			$layout = $this->getLayout();
			if ($id = (int) $this->getRequest()->getParams('id')) {
				if (!($eavAttribute =  Ccc::getModel('Eav_Attribute')->load($id))) {
					throw new Exception("Invalid Id.", 1);
				}
			}

			$layout->addContent('edit', $layout->createBlock('Eav_Attribute_Edit')->setData(['eavAttribute' => $eavAttribute]));
			$layout->render();
		} catch (Exception $e) {
			$this->getMessage()->addMessage($e->getMessage(),Model_Core_Message::FAILURE);
			$this->redirect('grid');
		}
	}

	public function saveAction()
	{
		try {
			if (!$this->getRequest()->isPost()) {
				throw new Exception("Invalid request.", 1);
			}

			if (!($postData = $this->getRequest()->getPost('eavAttribute'))) {
				throw new Exception("Invalid data posted.", 1);
			}

			if (!($optionsData = $this->getRequest()->getPost('options'))) {
				throw new Exception("Invalid data posted.", 1);
			}

			if ($attributeId = (int) $this->getRequest()->getParams('id')) {
				if (!($eavAttribute =  Ccc::getModel('Eav_Attribute')->load($attributeId))) {
					throw new Exception("Invalid Id.", 1);
				}
			}
			else {
				$eavAttribute =  Ccc::getModel('Eav_Attribute');
			}

			if (!$attribute = $eavAttribute->setData($postData)->save()) {
				throw new Exception("Unable to save.", 1);
			}

			else{
				$attributeId = $attribute->attribute_id;
				if(array_key_exists('exist', $optionsData)){
					$query = "SELECT * FROM `eav_attribute_option` WHERE `attribute_id` = $attributeId";
					$attributeOptions = Ccc::getModel('Eav_Attribute_Option')->fetchAll($query)->getData();
					foreach ($attributeOptions as $attributeOption) {
						if (!array_key_exists($attributeOption->option_id, $optionsData['exist'])) {
							$attributeOption->setData(['option_id' => $attributeOption->option_id]);
							if (!$attributeOption->delete()) {
								throw new Exception("Unable to delete.", 1);
							}
						}
					}
				}

				if (array_key_exists('new', $optionsData)) {
					foreach ($optionsData['new']['name'] as $optionData) {
						$option['name'] = $optionData;
						$option['attribute_id'] = $attributeId;
						Ccc::getModel('Eav_Attribute_Option')->setData($option)->save();
						unset($option);
					}
				}
				$this->getMessage()->addMessage('Data saved successfully.');
			}
		} catch (Exception $e) {
			$this->getMessage()->addMessage($e->getMessage(),Model_Core_Message::FAILURE);
		}
		
		$this->redirect('grid', null, [], true);
	}

	public function deleteAction()
	{
		try {
			if (!($id = (int) $this->getRequest()->getParams('id'))) {
				throw new Exception("Invalid request.", 1);
			}

			if (!($eavAttribute =  Ccc::getModel('Eav_Attribute')->load($id))) {
				throw new Exception("Invalid Id.", 1);
			}

			if (!$eavAttribute->delete()) {
				throw new Exception("Unable to delete.", 1);
			}

			$this->getMessage()->addMessage('Data deleted successfully.');
		} catch (Exception $e) {
			$this->getMessage()->addMessage($e->getMessage(),Model_Core_Message::FAILURE);
		}

		$this->redirect('grid', null, [], true);
	}	
}
?>