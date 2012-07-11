<?php
class BusinessstatesController extends AppController {

	var $name = 'Businessstates';


	function index() {
		$this->Businessstate->recursive = 0;
		$this->set('businessstates', $this->paginate());
		parent::loguea($this->data,$this->here);
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid businessstate', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('businessstate', $this->Businessstate->read(null, $id));
		parent::loguea($this->data,$this->here);
	}

	function add() {
		if (!empty($this->data)) {
			$this->Businessstate->create();
			if ($this->Businessstate->save($this->data)) {
				parent::loguea($this->data,$this->here);
				$this->Session->setFlash(__('The businessstate has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The businessstate could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid businessstate', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Businessstate->save($this->data)) {
				parent::loguea($this->data,$this->here);
				$this->Session->setFlash(__('The businessstate has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The businessstate could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Businessstate->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for businessstate', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Businessstate->delete($id)) {
			$this->Session->setFlash(__('Businessstate deleted', true));
			$this->redirect(array('action'=>'index'));
			parent::loguea($this->data,$this->here);
		}
		$this->Session->setFlash(__('Businessstate was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>
