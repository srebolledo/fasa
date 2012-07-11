<?php
class UnitiesController extends AppController {

	var $name = 'Unities';

	function index() {
		$this->Unity->recursive = 0;
		$this->set('unities', $this->paginate());
		parent::loguea($this->data,$this->here);
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid unity', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('unity', $this->Unity->read(null, $id));
		parent::loguea($this->data,$this->here);
	}

	function add() {
		if (!empty($this->data)) {
			$this->Unity->create();
			if ($this->Unity->save($this->data)) {
				parent::loguea($this->data,$this->here);
				$this->Session->setFlash(__('The unity has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The unity could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid unity', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Unity->save($this->data)) {
				parent::loguea($this->data,$this->here);
				$this->Session->setFlash(__('The unity has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The unity could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Unity->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for unity', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Unity->delete($id)) {
			parent::loguea($this->data,$this->here);
			$this->Session->setFlash(__('Unity deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Unity was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}


	function getName($id = null){
		if($id){
			$unity = $this->Unity->find("list",array("conditions"=>array("Unity.id"=>$id) ) ) ;

			foreach($unity as $u){
				return $u;			
			}


			
		}

	
	}
}
?>
