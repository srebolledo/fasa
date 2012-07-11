<?php
/* Tsubject Test cases generated on: 2011-01-12 00:01:28 : 1294801828*/
App::import('Model', 'Tsubject');

class TsubjectTestCase extends CakeTestCase {
	var $fixtures = array('app.tsubject');

	function startTest() {
		$this->Tsubject =& ClassRegistry::init('Tsubject');
	}

	function endTest() {
		unset($this->Tsubject);
		ClassRegistry::flush();
	}

}
?>