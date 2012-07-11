<?php
/* Position Test cases generated on: 2011-01-12 00:01:47 : 1294801787*/
App::import('Model', 'Position');

class PositionTestCase extends CakeTestCase {
	var $fixtures = array('app.position', 'app.participant', 'app.minuta', 'app.onereport', 'app.engineer', 'app.filial', 'app.tworeport', 'app.emsefor', 'app.unity', 'app.indicator', 'app.state', 'app.cartastate', 'app.proyectostate', 'app.projecttype');

	function startTest() {
		$this->Position =& ClassRegistry::init('Position');
	}

	function endTest() {
		unset($this->Position);
		ClassRegistry::flush();
	}

}
?>