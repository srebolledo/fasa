<?php
/* Ideas Test cases generated on: 2010-12-15 14:12:22 : 1292432722*/
App::import('Controller', 'Ideas');

class TestIdeasController extends IdeasController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class IdeasControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.idea', 'app.user', 'app.group', 'app.schedule');

	function startTest() {
		$this->Ideas =& new TestIdeasController();
		$this->Ideas->constructClasses();
	}

	function endTest() {
		unset($this->Ideas);
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