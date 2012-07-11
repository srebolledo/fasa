<?php
/* MinutasTdsubject Test cases generated on: 2011-01-12 22:01:12 : 1294882692*/
App::import('Model', 'MinutasTdsubject');

class MinutasTdsubjectTestCase extends CakeTestCase {
	var $fixtures = array('app.minutas_tdsubject', 'app.minuta', 'app.onereport', 'app.engineer', 'app.filial', 'app.tworeport', 'app.activity', 'app.emsefor', 'app.unity', 'app.state', 'app.participant', 'app.position', 'app.indicator', 'app.cartastate', 'app.proyectostate', 'app.projecttype', 'app.minutas_participant', 'app.tdsubject', 'app.tsubject', 'app.minutas_tsubject');

	function startTest() {
		$this->MinutasTdsubject =& ClassRegistry::init('MinutasTdsubject');
	}

	function endTest() {
		unset($this->MinutasTdsubject);
		ClassRegistry::flush();
	}

}
?>