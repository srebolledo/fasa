<?php
/* Positions Test cases generated on: 2011-01-12 23:01:02 : 1294884662*/
App::import('Controller', 'Positions');

class TestPositionsController extends PositionsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class PositionsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.position', 'app.participant', 'app.onereport', 'app.engineer', 'app.filial', 'app.tworeport', 'app.activity', 'app.emsefor', 'app.unity', 'app.state', 'app.minuta', 'app.minutas_participant', 'app.tdsubject', 'app.minutas_tdsubject', 'app.tsubject', 'app.minutas_tsubject', 'app.indicator', 'app.cartastate', 'app.proyectostate', 'app.projecttype');

	function startTest() {
		$this->Positions =& new TestPositionsController();
		$this->Positions->constructClasses();
	}

	function endTest() {
		unset($this->Positions);
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