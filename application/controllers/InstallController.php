<?php

class InstallController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
		$installModel = new Application_Model_Install;
		$success = $installModel->install();
		$this->view->assign('installSuccess', $success);
    }


}

