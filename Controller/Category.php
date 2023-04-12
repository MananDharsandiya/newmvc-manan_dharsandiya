<?php
class Controller_Category extends Controller_Core_Action
{
	public function gridAction()
	{
		try {
			$layout = $this->getLayout();
			$layout->addContent('grid', $layout->createBlock('Category_Grid'));
			$layout->render();
		} catch (Exception $e) {

		}
	}

	public function addAction()
	{
		try {
			$layout = $this->getLayout();
			$layout->addContent('add', $layout->createBlock('Category_Edit')->setData(['category' => Ccc::getModel('Category'), 'parentCategories' => Ccc::getModel('Category')->getParentCategories()]));
			$layout->render();
		} catch (Exception $e) {

		}
	}

	public function editAction()
	{
		try {
			if ($id = (int) $this->getRequest()->getParams('id')) {
				if (!($category = Ccc::getModel('Category')->load($id))) {
				throw new Exception("Invalid Id.", 1);
				}
			}

			$parentCategories = Ccc::getModel('Category')->getParentCategories();
			foreach ($parentCategories as $categoryId => $path) {
				if (str_contains($path, $category->path)) {
					unset($parentCategories[$categoryId]);
				}
			}

			$layout = $this->getLayout();
			$layout->addContent('edit', $layout->createBlock('Category_Edit')->setData(['category' => $category, 'parentCategories' => $parentCategories]));
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

			if (!($postData = $this->getRequest()->getPost('category'))) {
				throw new Exception("Invalid data posted.", 1);
			}

			if ($id = (int) $this->getRequest()->getParams('id')) {
				if (!($category = Ccc::getModel('Category')->load($id))) {
					throw new Exception("Invalid Id.", 1);
				}

				$category->updated_at = date("y-m-d H:i:s");
			} else {
				$category = Ccc::getModel('Category');
				$category->created_at = date("y-m-d H:i:s");
			}

			if (!$category->setData($postData)->save()) {
				throw new Exception("Unable to save.", 1);
			}

			$category->updatePath();
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

			if (!($category = Ccc::getModel('Category')->load($id))) {
				throw new Exception("Invalid Id.", 1);
			}

			$query = "DELETE FROM `category` WHERE `path` LIKE '{$category->path}/%' OR `path` = '{$category->path}'";
			if (!$category->getResource()->getAdapter()->delete($query)) {
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