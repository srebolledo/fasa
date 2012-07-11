<?php
/* Docent Test cases generated on: 2011-02-11 10:02:22 : 1297430542*/
App::import('Model', 'Docent');

class DocentTestCase extends CakeTestCase {
	var $fixtures = array('app.docent', 'app.emsefor', 'app.unity', 'app.onereport', 'app.engineer', 'app.filial', 'app.user', 'app.group', 'app.tworeport', 'app.activity', 'app.state', 'app.place', 'app.minuta', 'app.position', 'app.participant', 'app.indicator', 'app.ideasstate', 'app.cartastate', 'app.proyectostate');

	function startTest() {
		$this->Docent =& ClassRegistry::init('Docent');
	}

	function endTest() {
		unset($this->Docent);
		ClassRegistry::flush();
	}

}
?>