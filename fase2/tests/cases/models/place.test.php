<?php
/* Place Test cases generated on: 2011-01-26 11:01:02 : 1296051482*/
App::import('Model', 'Place');

class PlaceTestCase extends CakeTestCase {
	var $fixtures = array('app.place', 'app.tworeport', 'app.engineer', 'app.filial', 'app.user', 'app.group', 'app.activity', 'app.emsefor', 'app.unity', 'app.onereport', 'app.position', 'app.participant', 'app.indicator', 'app.ideasstate', 'app.cartastate', 'app.proyectostate', 'app.state', 'app.minuta');

	function startTest() {
		$this->Place =& ClassRegistry::init('Place');
	}

	function endTest() {
		unset($this->Place);
		ClassRegistry::flush();
	}

}
?>