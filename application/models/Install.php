<?php

class Application_Model_Install extends Application_Model_Abstract
{
	public function install() {
		$sql = <<<EOT
CREATE TABLE IF NOT EXISTS `bwin_todo` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`name` VARCHAR( 2000 ) NOT NULL ,
`complete` TINYINT NOT NULL DEFAULT  '0',
`insert_time` INT NOT NULL ,
`complete_time` INT NOT NULL DEFAULT  '0'
) ENGINE = MYISAM ;
EOT;
		return $this->amysql->query($sql);
	}
}

