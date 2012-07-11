<?php
class Onereport extends AppModel {
	var $name = 'Onereport';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Engineer' => array(
			'className' => 'Engineer',
			'foreignKey' => 'engineer_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Unity' => array(
			'className' => 'Unity',
			'foreignKey' => 'unity_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Emsefor' => array(
			'className' => 'Emsefor',
			'foreignKey' => 'emsefor_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Position' => array(
			'className' => 'Position',
			'foreignKey' => 'position_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Indicator' => array(
			'className' => 'Indicator',
			'foreignKey' => 'indicator_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Ideasstate' => array(
			'className' => 'Ideasstate',
			'foreignKey' => 'ideasstate_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Cartastate' => array(
			'className' => 'Cartastate',
			'foreignKey' => 'cartastate_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Proyectostate' => array(
			'className' => 'Proyectostate',
			'foreignKey' => 'proyectostate_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
    'Businessstate' => array(
			'className' => 'Businessstate',
			'foreignKey' => 'businessstate_id',
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

	var $hasOne = array(
		'Project' => array(
			'className' => 'Project',
			'foreignKey' => 'onereport_id',
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
	var $hasMany = array(	
		'Onereporthistory' => array(
			'className' => 'Onereporthistory',
			'foreignKey' => 'onereport_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => 'created DESC',
			'limit' => '1',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
?>
