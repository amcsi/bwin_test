<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

	public $amysql;
	public $loader;
	public $config;

	protected function _initAutoload() {
		require_once 'Zend/Loader/Autoloader.php';
		$loader = Zend_Loader_Autoloader::getInstance();
		$this->loader = $loader;
		return $loader;
	}

	protected function _initConfig() {
		$config = new Zend_Config($this->getOptions());
        Zend_Registry::set('config', $config);
		$this->config = $config;
        return $config;
	}

	protected function _initView() {
		$view = new Zend_View();
		return $view;
	}

	protected function _initLayout() {
		Zend_Layout::startMvc();
		return;
		$layout = new Zend_Layout();
 
		// Set a layout script path:
		$layout->setLayoutPath('/path/to/layouts');
		 
		// set some variables:
		$layout->content = $content;
		$layout->nav     = $nav;
		 
		// choose a different layout script:
		$layout->setLayout('foo');
		 
		// render final layout
		echo $layout->render();
	}

	protected function _initAMysql() {
		$this->bootstrap('autoload');
		$this->bootstrap('config');
		$this->loader->registerNamespace('AMysql');
		$dbRes = $this->config->resources->db;
		$params = $dbRes->params;
		$amysql = new AMysql($params->host, $params->username, $params->password);
		$amysql->selectDb($params->dbname);
		$this->amysql = $amysql;
		Zend_Registry::set('amysql', $amysql);
	}

}

