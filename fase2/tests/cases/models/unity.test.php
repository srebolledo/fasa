<?php
/* Unity Test cases generated on: 2011-01-12 00:01:37 : 1294801897*/
App::import('Model', 'Unity');

class UnityTestCase extends CakeTestCase {
	var $fixtures = array('app.unity', 'app.onereport', 'app.engineer', 'app.filial', 'app.minuta', 'app.participant', 'app.position', 'app.tworeport', 'app.activity', 'app.emsefor', 'app.state', 'app.indicator', 'app.cartastate', 'app.proyectostate', 'app.projecttype');

	function startTest() {
		$this->Unity =& ClassRegistry::init('Unity');
	}

	function endTest() {
		unset($this->Unity);
		ClassRegistry::flush();
	}

}
?>