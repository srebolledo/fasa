<?php
/* MinutasTsubject Test cases generated on: 2011-01-12 22:01:17 : 1294882697*/
App::import('Model', 'MinutasTsubject');

class MinutasTsubjectTestCase extends CakeTestCase {
	var $fixtures = array('app.minutas_tsubject', 'app.minuta', 'app.onereport', 'app.engineer', 'app.filial', 'app.tworeport', 'app.activity', 'app.emsefor', 'app.unity', 'app.state', 'app.participant', 'app.position', 'app.indicator', 'app.cartastate', 'app.proyectostate', 'app.projecttype', 'app.minutas_participant', 'app.tdsubject', 'app.minutas_tdsubject', 'app.tsubject');

	function startTest() {
		$this->MinutasTsubject =& ClassRegistry::init('MinutasTsubject');
	}

	function endTest() {
		unset($this->MinutasTsubject);
		ClassRegistry::flush();
	}

}
?>