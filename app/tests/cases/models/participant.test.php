<?php
/* Participant Test cases generated on: 2011-01-12 00:01:42 : 1294801782*/
App::import('Model', 'Participant');

class ParticipantTestCase extends CakeTestCase {
	var $fixtures = array('app.participant', 'app.position', 'app.minuta', 'app.onereport', 'app.engineer', 'app.filial', 'app.tworeport', 'app.emsefor', 'app.unity', 'app.indicator', 'app.state', 'app.cartastate', 'app.proyectostate', 'app.projecttype');

	function startTest() {
		$this->Participant =& ClassRegistry::init('Participant');
	}

	function endTest() {
		unset($this->Participant);
		ClassRegistry::flush();
	}

}
?>