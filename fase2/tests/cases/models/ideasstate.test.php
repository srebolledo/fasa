<?php
/* Ideasstate Test cases generated on: 2011-01-17 13:01:16 : 1295281636*/
App::import('Model', 'Ideasstate');

class IdeasstateTestCase extends CakeTestCase {
	var $fixtures = array('app.ideasstate', 'app.onereport', 'app.engineer', 'app.filial', 'app.tworeport', 'app.activity', 'app.emsefor', 'app.unity', 'app.state', 'app.minuta', 'app.indicator', 'app.cartastate', 'app.proyectostate', 'app.projecttype');

	function startTest() {
		$this->Ideasstate =& ClassRegistry::init('Ideasstate');
	}

	function endTest() {
		unset($this->Ideasstate);
		ClassRegistry::flush();
	}

}
?>