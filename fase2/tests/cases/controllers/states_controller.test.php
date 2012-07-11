<?php
/* States Test cases generated on: 2011-01-12 23:01:26 : 1294884686*/
App::import('Controller', 'States');

class TestStatesController extends StatesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class StatesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.state', 'app.onereport', 'app.engineer', 'app.filial', 'app.tworeport', 'app.activity', 'app.emsefor', 'app.unity', 'app.minuta', 'app.participant', 'app.position', 'app.minutas_participant', 'app.tdsubject', 'app.minutas_tdsubject', 'app.tsubject', 'app.minutas_tsubject', 'app.indicator', 'app.cartastate', 'app.proyectostate', 'app.projecttype');

	function startTest() {
		$this->States =& new TestStatesController();
		$this->States->constructClasses();
	}

	function endTest() {
		unset($this->States);
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