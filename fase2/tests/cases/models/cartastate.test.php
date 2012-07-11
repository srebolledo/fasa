<?php
/* Cartastate Test cases generated on: 2011-01-12 00:01:41 : 1294801721*/
App::import('Model', 'Cartastate');

class CartastateTestCase extends CakeTestCase {
	var $fixtures = array('app.cartastate', 'app.onereport');

	function startTest() {
		$this->Cartastate =& ClassRegistry::init('Cartastate');
	}

	function endTest() {
		unset($this->Cartastate);
		ClassRegistry::flush();
	}

}
?>