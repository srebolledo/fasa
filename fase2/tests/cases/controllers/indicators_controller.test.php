<?php
/* Indicators Test cases generated on: 2011-01-12 23:01:38 : 1294884638*/
App::import('Controller', 'Indicators');

class TestIndicatorsController extends IndicatorsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class IndicatorsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.indicator', 'app.onereport', 'app.engineer', 'app.filial', 'app.tworeport', 'app.activity', 'app.emsefor', 'app.unity', 'app.state', 'app.minuta', 'app.participant', 'app.position', 'app.minutas_participant', 'app.tdsubject', 'app.minutas_tdsubject', 'app.tsubject', 'app.minutas_tsubject', 'app.cartastate', 'app.proyectostate', 'app.projecttype');

	function startTest() {
		$this->Indicators =& new TestIndicatorsController();
		$this->Indicators->constructClasses();
	}

	function endTest() {
		unset($this->Indicators);
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