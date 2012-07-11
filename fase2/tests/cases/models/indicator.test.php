<?php
/* Indicator Test cases generated on: 2011-01-12 00:01:25 : 1294801765*/
App::import('Model', 'Indicator');

class IndicatorTestCase extends CakeTestCase {
	var $fixtures = array('app.indicator', 'app.onereport');

	function startTest() {
		$this->Indicator =& ClassRegistry::init('Indicator');
	}

	function endTest() {
		unset($this->Indicator);
		ClassRegistry::flush();
	}

}
?>