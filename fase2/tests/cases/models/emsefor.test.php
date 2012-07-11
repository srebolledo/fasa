<?php
/* Emsefor Test cases generated on: 2011-01-12 00:01:48 : 1294801728*/
App::import('Model', 'Emsefor');

class EmseforTestCase extends CakeTestCase {
	var $fixtures = array('app.emsefor', 'app.onereport', 'app.tworeport');

	function startTest() {
		$this->Emsefor =& ClassRegistry::init('Emsefor');
	}

	function endTest() {
		unset($this->Emsefor);
		ClassRegistry::flush();
	}

}
?>