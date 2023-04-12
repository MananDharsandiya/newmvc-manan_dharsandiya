<?php
class Controller_Admin extends Controller_Core_Action
{
	public function gridAction()
	{
		try {
			$layout = $this->getLayout();
			$layout->addContent('grid', $layout->createBlock('Admin_Grid'));
			$layout->render();
		} catch (Exception $e) {

		}
	}

	public function addAction()
	{
		try {
			$layout = $this->getLayout();
			$layout->addContent('add', $layout->createBlock('Admin_Edit')->setData(['admin' => Ccc::getModel('Admin')]));
			$layout->render();
		} catch (Exception $e) {

		}
	}

	public function editAction()
	{
		try {
			if ($id = (int) $this->getRequest()->getParams('id')) {
				if (!($admin = Ccc::getModel('Admin')->load($id))) {
					throw new Exception("Invalid Id.", 1);
				}
			}

			$layout = $this->getLayout();
			$layout->addContent('edit', $layout->createBlock('Admin_Edit')->setData(['admin' => $admin]));
			$layout->render();
		} catch (Exception $e) {
			$this->getMessage()->addMessage($e->getMessage(), Model_Core_Message::FAILURE);
			$this->redirect('grid');
		}
	}

	public function saveAction()
	{
		try {
			if (!$this->getRequest()->isPost()) {
				throw new Exception("Invalid request.", 1);
			}

			if (!($postData = $this->getRequest()->getPost('admin'))) {
				throw new Exception("Invalid data posted.", 1);
			}

			if ($id = (int) $this->getRequest()->getParams('id')) {
				if (!($admin = Ccc::getModel('Admin')->load($id))) {
					throw new Exception("Invalid Id.", 1);
				}

				$admin->updated_at = date("y-m-d H:i:s");
			} else {
				$admin = Ccc::getModel('Admin');
				$admin->created_at = date("y-m-d H:i:s");
			}

			if (!$admin->setData($postData)->save()) {
				throw new Exception("Unable to save.", 1);
			}

			$this->getMessage()->addMessage('Data saved successfully.');
		} catch (Exception $e) {
			$this->getMessage()->addMessage($e->getMessage(), Model_Core_Message::FAILURE);
		}

		$this->redirect('grid', null, [], true);
	}

	public function deleteAction()
	{
		try {
			if (!($id = (int) $this->getRequest()->getParams('id'))) {
				throw new Exception("Invalid request.", 1);
			}

			if (!($admin = Ccc::getModel('Admin')->load($id))) {
				throw new Exception("Invalid Id.", 1);
			}

			if (!$admin->delete()) {
				throw new Exception("Unable to delete.", 1);
			}

			$this->getMessage()->addMessage('Data deleted successfully.');
		} catch (Exception $e) {
			$this->getMessage()->addMessage($e->getMessage(), Model_Core_Message::FAILURE);
		}

		$this->redirect('grid', null, [], true);
	}

}
?>