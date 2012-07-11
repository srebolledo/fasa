<?php
/* MinutasTsubjects Test cases generated on: 2011-01-12 22:01:18 : 1294882698*/
App::import('Controller', 'MinutasTsubjects');

class TestMinutasTsubjectsController extends MinutasTsubjectsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class MinutasTsubjectsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.minutas_tsubject', 'app.minuta', 'app.onereport', 'app.engineer', 'app.filial', 'app.tworeport', 'app.activity', 'app.emsefor', 'app.unity', 'app.state', 'app.participant', 'app.position', 'app.indicator', 'app.cartastate', 'app.proyectostate', 'app.projecttype', 'app.minutas_participant', 'app.tdsubject', 'app.minutas_tdsubject', 'app.tsubject');

	function startTest() {
		$this->MinutasTsubjects =& new TestMinutasTsubjectsController();
		$this->MinutasTsubjects->constructClasses();
	}

	function endTest() {
		unset($this->MinutasTsubjects);
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