<?php
class Controller_Product extends Controller_Core_Action
{
	public function gridAction()
	{
		try {
			$layout = $this->getLayout();
			$grid = $layout->createBlock('Product_Grid');
			$layout->addContent('grid', $grid);
			$layout->render();
		} catch (Exception $e) {

		}
	}

	public function addAction()
	{
		try {
			$layout = $this->getLayout();
			$layout->addContent('add', $layout->createBlock('Product_Edit')->setData(['product' => Ccc::getModel('Product')]));
			$layout->render();
		} catch (Exception $e) {
			
		}
	}

	public function editAction()
	{
		try {
			$layout = $this->getLayout();
			if ($id = (int) $this->getRequest()->getParams('id')) {
				if (!($product =  Ccc::getModel('Product')->load($id))) {
					throw new Exception("Invalid Id.", 1);
				}
			}

			$layout->addContent('edit', $layout->createBlock('Product_Edit')->setData(['product' => $product]));
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

			if (!($postData = $this->getRequest()->getPost('product'))) {
				throw new Exception("Invalid data posted.", 1);
			}

			if ($id = (int) $this->getRequest()->getParams('id')) {
				if (!($product =  Ccc::getModel('Product')->load($id))) {
					throw new Exception("Invalid Id.", 1);
				}

				$product->updated_at = date("y-m-d H:i:s");
			}
			else {
				$product =  Ccc::getModel('Product');
				$product->created_at = date("y-m-d H:i:s");
			}

			if (!$product->setData($postData)->save()) {
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

			if (!($product =  Ccc::getModel('Product')->load($id))) {
				throw new Exception("Invalid Id.", 1);
			}

			if (!$product->delete()) {
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