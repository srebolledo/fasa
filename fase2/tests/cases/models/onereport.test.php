<?php
/* Onereport Test cases generated on: 2011-01-12 00:01:36 : 1294801776*/
App::import('Model', 'Onereport');

class OnereportTestCase extends CakeTestCase {
	var $fixtures = array('app.onereport', 'app.engineer', 'app.filial', 'app.minuta', 'app.participant', 'app.tworeport', 'app.emsefor', 'app.unity', 'app.indicator', 'app.state', 'app.cartastate', 'app.proyectostate', 'app.projecttype');

	function startTest() {
		$this->Onereport =& ClassRegistry::init('Onereport');
	}

	function endTest() {
		unset($this->Onereport);
		ClassRegistry::flush();
	}

}
?>