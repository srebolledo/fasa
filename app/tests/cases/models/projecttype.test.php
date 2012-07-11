<?php
/* Projecttype Test cases generated on: 2011-01-12 00:01:59 : 1294801799*/
App::import('Model', 'Projecttype');

class ProjecttypeTestCase extends CakeTestCase {
	var $fixtures = array('app.projecttype', 'app.onereport', 'app.engineer', 'app.filial', 'app.minuta', 'app.participant', 'app.position', 'app.tworeport', 'app.emsefor', 'app.unity', 'app.indicator', 'app.state', 'app.cartastate', 'app.proyectostate');

	function startTest() {
		$this->Projecttype =& ClassRegistry::init('Projecttype');
	}

	function endTest() {
		unset($this->Projecttype);
		ClassRegistry::flush();
	}

}
?>