<?php
/* Tdsubject Test cases generated on: 2011-01-12 00:01:23 : 1294801823*/
App::import('Model', 'Tdsubject');

class TdsubjectTestCase extends CakeTestCase {
	var $fixtures = array('app.tdsubject');

	function startTest() {
		$this->Tdsubject =& ClassRegistry::init('Tdsubject');
	}

	function endTest() {
		unset($this->Tdsubject);
		ClassRegistry::flush();
	}

}
?>