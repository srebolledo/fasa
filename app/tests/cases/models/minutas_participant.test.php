<?php
/* MinutasParticipant Test cases generated on: 2011-01-12 23:01:12 : 1294886772*/
App::import('Model', 'MinutasParticipant');

class MinutasParticipantTestCase extends CakeTestCase {
	var $fixtures = array('app.minutas_participant', 'app.minuta', 'app.tworeport', 'app.engineer', 'app.filial', 'app.onereport', 'app.emsefor', 'app.unity', 'app.participant', 'app.position', 'app.indicator', 'app.state', 'app.cartastate', 'app.proyectostate', 'app.projecttype', 'app.activity', 'app.tdsubject', 'app.minutas_tdsubject', 'app.tsubject', 'app.minutas_tsubject');

	function startTest() {
		$this->MinutasParticipant =& ClassRegistry::init('MinutasParticipant');
	}

	function endTest() {
		unset($this->MinutasParticipant);
		ClassRegistry::flush();
	}

}
?>