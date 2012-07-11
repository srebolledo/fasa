<?php
/* Tworeports Test cases generated on: 2011-01-17 14:01:14 : 1295284334*/
App::import('Controller', 'Tworeports');

class TestTworeportsController extends TworeportsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class TworeportsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.tworeport', 'app.engineer', 'app.filial', 'app.onereport', 'app.emsefor', 'app.unity', 'app.indicator', 'app.ideasstate', 'app.cartastate', 'app.proyectostate', 'app.projecttype', 'app.activity', 'app.state', 'app.minuta');

	function startTest() {
		$this->Tworeports =& new TestTworeportsController();
		$this->Tworeports->constructClasses();
	}

	function endTest() {
		unset($this->Tworeports);
		ClassRegistry::flush();
	}

	function testIndex() {

	}

	function testView() {

	}

	function testAdd() {

	}

	function testEdit() {

	}

	function testDelete() {

	}

}
?>