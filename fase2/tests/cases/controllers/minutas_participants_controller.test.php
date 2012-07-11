<?php
/* MinutasParticipants Test cases generated on: 2011-01-12 23:01:15 : 1294886775*/
App::import('Controller', 'MinutasParticipants');

class TestMinutasParticipantsController extends MinutasParticipantsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class MinutasParticipantsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.minutas_participant', 'app.minuta', 'app.tworeport', 'app.engineer', 'app.filial', 'app.onereport', 'app.emsefor', 'app.unity', 'app.participant', 'app.position', 'app.indicator', 'app.state', 'app.cartastate', 'app.proyectostate', 'app.projecttype', 'app.activity', 'app.tdsubject', 'app.minutas_tdsubject', 'app.tsubject', 'app.minutas_tsubject');

	function startTest() {
		$this->MinutasParticipants =& new TestMinutasParticipantsController();
		$this->MinutasParticipants->constructClasses();
	}

	function endTest() {
		unset($this->MinutasParticipants);
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