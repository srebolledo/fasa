<?php
class Ideasstate extends AppModel {
	var $name = 'Ideasstate';
	var $displayField = 'nombre';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasMany = array(
		'Onereport' => array(
			'className' => 'Onereport',
			'foreignKey' => 'ideasstate_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);


}
?>
