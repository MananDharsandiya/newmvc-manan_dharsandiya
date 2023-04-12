<?php
class Controller_Payment extends Controller_Core_Action
{
	public function gridAction()
	{
		try {
			$layout = $this->getLayout();
			$layout->addContent('grid', $layout->createBlock('Payment_Grid'));
			$layout->render();
		} catch (Exception $e) {

		}
	}

	public function addAction()
	{
		try {
			$layout = $this->getLayout();
			$layout->addContent('add', $layout->createBlock('Payment_Edit')->setData(['payment' => Ccc::getModel('Payment')]));
			$layout->render();
		} catch (Exception $e) {
			
		}
	}

	public function editAction()
	{
		try {
			if ($id = (int) $this->getRequest()->getParams('id')) {
				if (!($payment =  Ccc::getModel('Payment')->load($id))) {
					throw new Exception("Invalid Id.", 1);
				}
			}

			$layout = $this->getLayout();
			$layout->addContent('edit', $layout->createBlock('Payment_Edit')->setData(['payment' => $payment]));
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

			if (!($postData = $this->getRequest()->getPost('payment'))) {
				throw new Exception("Invalid data posted.", 1);
			}

			if ($id = (int) $this->getRequest()->getParams('id')) {
				if (!($payment =  Ccc::getModel('Payment')->load($id))) {
					throw new Exception("Invalid Id.", 1);
				}

				$payment->updated_at = date("y-m-d H:i:s");
			}
			else {
				$payment =  Ccc::getModel('Payment');
				$payment->created_at = date("y-m-d H:i:s");
			}

			if (!$payment->setData($postData)->save()) {
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

			if (!($payment =  Ccc::getModel('Payment')->load($id))) {
				throw new Exception("Invalid Id.", 1);
			}

			if (!$payment->delete()) {
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