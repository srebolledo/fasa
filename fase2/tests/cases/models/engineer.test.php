<?php
/* Engineer Test cases generated on: 2011-01-12 00:01:02 : 1294801742*/
App::import('Model', 'Engineer');

class EngineerTestCase extends CakeTestCase {
	var $fixtures = array('app.engineer', 'app.filial', 'app.minuta', 'app.onereport', 'app.tworeport');

	function startTest() {
		$this->Engineer =& ClassRegistry::init('Engineer');
	}

	function endTest() {
		unset($this->Engineer);
		ClassRegistry::flush();
	}

}
?>