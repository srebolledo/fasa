<?php
class Tsubject extends AppModel {
	var $name = 'Tsubject';
	var $displayField = 'descripcion';
	var $validate = array(
		'tiempo' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasAndBelongsToMany = array(
		'Minuta' => array(
			'className' => 'Minuta',
			'joinTable' => 'minutas_tsubjects',
			'foreignKey' => 'tsubject_id',
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
