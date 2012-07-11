<?php
class Tdsubject extends AppModel {
	var $name = 'Tdsubject';
	var $displayField = 'descripcion';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasAndBelongsToMany = array(
		'Minuta' => array(
			'className' => 'Minuta',
			'joinTable' => 'minutas_tdsubjects',
			'foreignKey' => 'tdsubject_id',
			'associationForeignKey' => 'minuta_id',
			'unique' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		)
	);

}
?>
