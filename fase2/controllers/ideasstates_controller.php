<?php
class IdeasstatesController extends AppController {

	var $name = 'Ideasstates';

	function index() {
		$this->Ideasstate->recursive = 0;
		$this->set('ideasstates', $this->paginate());
		parent::loguea($this->data,$this->here);
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid ideasstate', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('ideasstate', $this->Ideasstate->read(null, $id));
		parent::loguea($this->data,$this->here);
	}

	function add() {
		if (!empty($this->data)) {
			$this->Ideasstate->create();
			if ($this->Ideasstate->save($this->data)) {
				parent::loguea($this->data,$this->here);
				$this->Session->setFlash(__('The ideasstate has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The ideasstate could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid ideasstate', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Ideasstate->save($this->data)) {
				parent::loguea($this->data,$this->here);
				$this->Session->setFlash(__('The ideasstate has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The ideasstate could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Ideasstate->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for ideasstate', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Ideasstate->delete($id)) {
			parent::loguea($this->data,$this->here);
			$this->Session->setFlash(__('Ideasstate deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Ideasstate was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}

	function getName($id){
		if($id){
			$emsefor = $this->Ideasstate->find("list",array("conditions"=>array("Ideasstate.id"=>$id) ) ) ;

			foreach($emsefor as $e){
				return $e;			
			}


			
		}
	}
}
?>
