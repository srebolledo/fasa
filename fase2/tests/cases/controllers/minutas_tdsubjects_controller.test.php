<?php
/* MinutasTdsubjects Test cases generated on: 2011-01-12 22:01:13 : 1294882693*/
App::import('Controller', 'MinutasTdsubjects');

class TestMinutasTdsubjectsController extends MinutasTdsubjectsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class MinutasTdsubjectsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.minutas_tdsubject', 'app.minuta', 'app.onereport', 'app.engineer', 'app.filial', 'app.tworeport', 'app.activity', 'app.emsefor', 'app.unity', 'app.state', 'app.participant', 'app.position', 'app.indicator', 'app.cartastate', 'app.proyectostate', 'app.projecttype', 'app.minutas_participant', 'app.tdsubject', 'app.tsubject', 'app.minutas_tsubject');

	function startTest() {
		$this->MinutasTdsubjects =& new TestMinutasTdsubjectsController();
		$this->MinutasTdsubjects->constructClasses();
	}

	function endTest() {
		unset($this->MinutasTdsubjects);
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