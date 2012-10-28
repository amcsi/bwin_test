<?php

abstract class Application_Model_Abstract
{

	public $amysql;

	public function __construct() {
		$amysql = Zend_Registry::get('amysql');
		$this->amysql = $amysql;
		$this->init();
	}

	public function init() {

	}



}

