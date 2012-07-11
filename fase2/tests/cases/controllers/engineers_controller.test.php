<?php
/* Engineers Test cases generated on: 2011-01-12 23:01:21 : 1294884621*/
App::import('Controller', 'Engineers');

class TestEngineersController extends EngineersController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class EngineersControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.engineer', 'app.filial', 'app.onereport', 'app.emsefor', 'app.tworeport', 'app.activity', 'app.unity', 'app.state', 'app.minuta', 'app.participant', 'app.position', 'app.minutas_participant', 'app.tdsubject', 'app.minutas_tdsubject', 'app.tsubject', 'app.minutas_tsubject', 'app.indicator', 'app.cartastate', 'app.proyectostate', 'app.projecttype');

	function startTest() {
		$this->Engineers =& new TestEngineersController();
		$this->Engineers->constructClasses();
	}

	function endTest() {
		unset($this->Engineers);
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