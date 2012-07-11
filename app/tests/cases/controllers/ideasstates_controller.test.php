<?php
/* Ideasstates Test cases generated on: 2011-01-17 13:01:16 : 1295281636*/
App::import('Controller', 'Ideasstates');

class TestIdeasstatesController extends IdeasstatesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class IdeasstatesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.ideasstate', 'app.onereport', 'app.engineer', 'app.filial', 'app.tworeport', 'app.activity', 'app.emsefor', 'app.unity', 'app.state', 'app.minuta', 'app.indicator', 'app.cartastate', 'app.proyectostate', 'app.projecttype');

	function startTest() {
		$this->Ideasstates =& new TestIdeasstatesController();
		$this->Ideasstates->constructClasses();
	}

	function endTest() {
		unset($this->Ideasstates);
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