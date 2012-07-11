<?php
/* Proyectostate Test cases generated on: 2011-01-12 00:01:05 : 1294801805*/
App::import('Model', 'Proyectostate');

class ProyectostateTestCase extends CakeTestCase {
	var $fixtures = array('app.proyectostate', 'app.onereport', 'app.engineer', 'app.filial', 'app.minuta', 'app.participant', 'app.position', 'app.tworeport', 'app.emsefor', 'app.unity', 'app.indicator', 'app.state', 'app.cartastate', 'app.projecttype');

	function startTest() {
		$this->Proyectostate =& ClassRegistry::init('Proyectostate');
	}

	function endTest() {
		unset($this->Proyectostate);
		ClassRegistry::flush();
	}

}
?>