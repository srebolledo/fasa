<?php
/* Places Test cases generated on: 2011-01-26 11:01:03 : 1296051483*/
App::import('Controller', 'Places');

class TestPlacesController extends PlacesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class PlacesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.place', 'app.tworeport', 'app.engineer', 'app.filial', 'app.user', 'app.group', 'app.activity', 'app.emsefor', 'app.unity', 'app.onereport', 'app.position', 'app.participant', 'app.indicator', 'app.ideasstate', 'app.cartastate', 'app.proyectostate', 'app.state', 'app.minuta');

	function startTest() {
		$this->Places =& new TestPlacesController();
		$this->Places->constructClasses();
	}

	function endTest() {
		unset($this->Places);
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