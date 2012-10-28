<?php

class Application_Model_Todo extends Application_Model_Abstract
{

	public $tableName;

	public function init() {
		$this->tableName = 'bwin_todo';
	}

	public function getAll($options = array ()) {
		$orders = array ();
		$orders[] = 'name ASC';
		if (!empty($options['order_complete'])) {
			array_unshift($orders, 'complete ASC');
		}
		$order = join(', ', $orders);
		$sql = "SELECT * FROM $this->tableName
			ORDER BY $order
			";
		$stmt = $this->amysql->query($sql);
		$ret = $stmt->fetchAllAssoc();
		if (!empty($options['template'])) {
			$this->amendWithTemplateData($ret);
		}
		return $ret;
	}

	public function amendWithTemplateData(&$input) {
		if (!$input) {
			return;
		}
		reset($input);
		if (is_numeric(key($input))) {
			$rows =& $input;
		}
		else {
			$rows = array ();
			$rows[] =& $input;
		}
		foreach ($rows as &$row) {
			$row['completed_display_date'] = date(
				'd/m/Y H:i:s', $row['complete_time']
			);
		}

	}

	public function createNew($name) {
		$time = time();
		$data = array ();
		$data['name'] = $name;
		$data['insert_time'] = $time;
		return $this->amysql->insert($this->tableName, $data);
	}

	public function markComplete($id) {
		$time = time();
		$data = array ();
		$data['complete'] = 1;
		$data['complete_time'] = $time;
		return $this->amysql->update($this->tableName, $data, 'id = ?', $id);
	}

	public function changeName($id, $name) {
		$data = array ();
		$data['name'] = $name;
		return $this->amysql->update($this->tableName, $data, 'id = ?', $id);
	}

}

