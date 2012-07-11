<?php
class Capasist extends AppModel {
	var $name = 'Capasist';
	var $validate = array(
		'emsefor_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'total' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'capacitation_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Emsefor' => array(
			'className' => 'Emsefor',
			'foreignKey' => 'emsefor_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Capacitation' => array(
			'className' => 'Capacitation',
			'foreignKey' => 'capacitation_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
?>