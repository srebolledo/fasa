<?php
/* Filial Test cases generated on: 2011-01-12 00:01:16 : 1294801756*/
App::import('Model', 'Filial');

class FilialTestCase extends CakeTestCase {
	var $fixtures = array('app.filial', 'app.engineer', 'app.minuta', 'app.onereport', 'app.tworeport');

	function startTest() {
		$this->Filial =& ClassRegistry::init('Filial');
	}

	function endTest() {
		unset($this->Filial);
		ClassRegistry::flush();
	}

}
?>