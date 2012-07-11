<?php
/* Company Test cases generated on: 2010-12-15 14:12:23 : 1292432963*/
App::import('Model', 'Company');

class CompanyTestCase extends CakeTestCase {
	var $fixtures = array('app.company', 'app.schedule', 'app.place', 'app.user', 'app.group', 'app.idea');

	function startTest() {
		$this->Company =& ClassRegistry::init('Company');
	}

	function endTest() {
		unset($this->Company);
		ClassRegistry::flush();
	}

}
?>