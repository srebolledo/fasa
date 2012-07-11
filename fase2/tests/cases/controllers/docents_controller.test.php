<?php
/* Docents Test cases generated on: 2011-02-11 10:02:23 : 1297430543*/
App::import('Controller', 'Docents');

class TestDocentsController extends DocentsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class DocentsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.docent', 'app.emsefor', 'app.unity', 'app.onereport', 'app.engineer', 'app.filial', 'app.user', 'app.group', 'app.tworeport', 'app.activity', 'app.state', 'app.place', 'app.minuta', 'app.position', 'app.participant', 'app.indicator', 'app.ideasstate', 'app.cartastate', 'app.proyectostate');

	function startTest() {
		$this->Docents =& new TestDocentsController();
		$this->Docents->constructClasses();
	}

	function endTest() {
		unset($this->Docents);
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