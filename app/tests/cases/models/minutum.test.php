<?php
/* Minutum Test cases generated on: 2011-01-17 10:01:06 : 1295270466*/
App::import('Model', 'Minutum');

class MinutumTestCase extends CakeTestCase {
	function startTest() {
		$this->Minutum =& ClassRegistry::init('Minutum');
	}

	function endTest() {
		unset($this->Minutum);
		ClassRegistry::flush();
	}

}
?>