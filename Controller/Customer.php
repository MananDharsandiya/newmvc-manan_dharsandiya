<?php 
class Controller_Customer extends Controller_Core_Action
{
	public function gridAction()
	{
		try {
			$layout = $this->getLayout();
			$layout->addContent('grid', $layout->createBlock('Customer_Grid'));
			$layout->render();
		} catch (Exception $e) {

		}
	}

	public function addAction()
	{
		try {
			$layout = $this->getLayout();
			$layout->addContent('add', $layout->createBlock('Customer_Edit')->setData(['customer' => Ccc::getModel('Customer'), 'customerAddress' => Ccc::getModel('Customer')]));
			$layout->render();
		} catch (Exception $e) {
			
		}
	}

	public function editAction()
	{
		try {
			$this->getMessage()->getSession()->start();
			if ($id = (int) $this->getRequest()->getParams('id')) {
				if (!($customer = Ccc::getModel('Customer')->load($id))) {
					throw new Exception("Invalid Id.", 1);
				}
			}

			$customerAddress = Ccc::getModel('Customer');
			$customerAddress->getResource()->setTableName('customer_address');
			if (!$customerAddress->load($id)) {
				throw new Exception("Invalid Id.", 1);
			}

			$layout = $this->getLayout();
			$layout->addContent('edit', $layout->createBlock('Customer_Edit')->setData(['customer' => $customer, 'customerAddress' => $customerAddress]));
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

			if (!($postData = $this->getRequest()->getPost('customer'))) {
				throw new Exception("Invalid data posted.", 1);
			}

			if ($id = (int) $this->getRequest()->getParams('id')) {
				if (!($customer =  Ccc::getModel('Customer')->load($id))) {
					throw new Exception("Invalid Id.", 1);
				}

				$customer->updated_at = date("y-m-d H:i:s");
			}
			else {
				$customer =  Ccc::getModel('Customer');
				$customer->created_at = date("y-m-d H:i:s");
			}

			if (!($customer = $customer->setData($postData)->save())) {
				throw new Exception("Unable to save.", 1);
			}

			if (!($postData = $this->getRequest()->getPost('customerAddress'))) {
				throw new Exception("Invalid data posted.", 1);
			}

			if ($id = (int) $this->getRequest()->getParams('id')) {
				$customerAddress =  Ccc::getModel('Customer');
				$customerAddress->getResource()->setTableName('customer_address');
				if (!$customerAddress->load($id)) {
					throw new Exception("Invalid Id.", 1);
				}

				$customerAddress->customer_id = $id;
			}
			else {
				$customerAddress =  Ccc::getModel('Customer');
				$customerAddress->getResource()->setTableName('customer_address')->setPrimaryKey('address_id');
				$customerAddress->customer_id = $customer->customer_id;
			}

			if (!$customerAddress->setData($postData)->save()) {
				throw new Exception("Unable to save.", 1);
			}

			$this->getMessage()->addMessage('Data saved successfully.');
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

			if (!($customer =  Ccc::getModel('Customer')->load($id))) {
				throw new Exception("Invalid Id.", 1);
			}

			if (!$customer->delete()) {
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