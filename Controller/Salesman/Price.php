<?php
class Controller_Salesman_Price extends Controller_Core_Action
{
	public function gridAction()
	{
		try {
			if (!($id = (int) $this->getRequest()->getParams('id'))) {
				throw new Exception("Invalid request.", 1);
			}

			$layout = $this->getLayout();
			$layout->addContent('grid', $layout->createBlock('Salesman_Price_Grid'));
			$layout->render();
		} catch (Exception $e) {

		}
	}

	public function saveAction()
	{
		try {
			if (!$this->getRequest()->isPost()) {
				throw new Exception("Invalid request.", 1);
			}

			if (!($postData = $this->getRequest()->getPost('salesmanPrice'))) {
				throw new Exception("Invalid data posted.", 1);
			}

			if (!$salesmanId = (int) $this->getRequest()->getParams('id')) {
					throw new Exception("Invalid Id.", 1);
			}

			foreach ($postData as $productId => $price) {
				$query = "SELECT * FROM `salesman_price` WHERE `product_id` = '{$productId}' AND `salesman_id` = '{$salesmanId}'";
				if (!Ccc::getModel('Salesman_Price')->fetchRow($query)) {
					$prices = ['salesman_price' => $price, 'salesman_id' => $salesmanId, 'product_id' => $productId];
					if (!Ccc::getModel('Salesman_Price')->setData($prices)->save()) {
						throw new Exception("Unable to save.", 1);
					}

				}
				else {
					$prices = ['salesman_price' => $price];
					$condition = ['salesman_id' => $salesmanId, 'product_id'=> $productId];
					if (!Ccc::getModel('Salesman_Price')->getResource()->update($prices, $condition)) {
						throw new Exception("Unable to save.", 1);
					}

				}
			}

			$this->getMessage()->addMessage('Data saved successfully.');
		} catch (Exception $e) {
			$this->getMessage()->addMessage($e->getMessage(),Model_Core_Message::FAILURE);
		}
		
		$this->redirect('grid', null, ['id' => $salesmanId], true);
	}

	public function deleteAction()
	{
		try {
			if (!($salesmanId = (int) $this->getRequest()->getParams('id'))) {
				throw new Exception("Invalid request.", 1);
			}

			if (!($productId = (int) $this->getRequest()->getParams('product_id'))) {
				throw new Exception("Invalid request.", 1);
			}

			$id = ['salesman_id' => $salesmanId, 'product_id' => $productId];
			if (!Ccc::getModel('Salesman_Price')->getResource()->delete($id)) {
				throw new Exception("Unable to delete.", 1);
			}

			$this->getMessage()->addMessage('Data deleted successfully.');
		} catch (Exception $e) {
			$this->getMessage()->addMessage($e->getMessage(),Model_Core_Message::FAILURE);
		}

		$this->redirect('grid', null, ['id' => $salesmanId], true);
	}

}
?>