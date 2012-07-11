<?php
/* Activity Test cases generated on: 2011-01-12 00:01:45 : 1294801905*/
App::import('Model', 'Activity');

class ActivityTestCase extends CakeTestCase {
	var $fixtures = array('app.activity', 'app.tworeport', 'app.engineer', 'app.filial', 'app.minuta', 'app.onereport', 'app.emsefor', 'app.unity', 'app.participant', 'app.position', 'app.indicator', 'app.state', 'app.cartastate', 'app.proyectostate', 'app.projecttype');

	function startTest() {
		$this->Activity =& ClassRegistry::init('Activity');
	}

	function endTest() {
		unset($this->Activity);
		ClassRegistry::flush();
	}

}
?>