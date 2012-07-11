<?php
/* State Test cases generated on: 2011-01-12 00:01:12 : 1294801812*/
App::import('Model', 'State');

class StateTestCase extends CakeTestCase {
	var $fixtures = array('app.state', 'app.onereport', 'app.engineer', 'app.filial', 'app.minuta', 'app.participant', 'app.position', 'app.tworeport', 'app.emsefor', 'app.unity', 'app.indicator', 'app.cartastate', 'app.proyectostate', 'app.projecttype');

	function startTest() {
		$this->State =& ClassRegistry::init('State');
	}

	function endTest() {
		unset($this->State);
		ClassRegistry::flush();
	}

}
?>