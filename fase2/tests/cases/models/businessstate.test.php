<?php
/* Businessstate Test cases generated on: 2011-03-22 09:03:29 : 1300797449*/
App::import('Model', 'Businessstate');

class BusinessstateTestCase extends CakeTestCase {
	var $fixtures = array('app.businessstate');

	function startTest() {
		$this->Businessstate =& ClassRegistry::init('Businessstate');
	}

	function endTest() {
		unset($this->Businessstate);
		ClassRegistry::flush();
	}

}
?>