<?php

class IndexController extends Zend_Controller_Action
{

	public $todoModel;

    public function init()
    {
		$this->todoModel = new Application_Model_Todo;
    }

    public function indexAction()
    {
		$todoModel = $this->todoModel;

		$options = array ();
		$options['order_complete'] = true;
		$options['template'] = true;
		$todos = $todoModel->getAll($options);
		$this->view->todos = $todos;
    }

	public function editAction() {
		$todoModel = $this->todoModel;

		$markComplete = filter_input(INPUT_POST, 'mark_complete');
		if ($markComplete) {
			$todoModel->markComplete($markComplete);
		}

		$insertNew = !empty($_POST['insert_new']);
		if ($insertNew) {
			$todoModel->createNew($_POST['name']);
		}

		$this->_redirect('index');
	}
}

