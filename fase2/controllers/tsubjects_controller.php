<?php
class TsubjectsController extends AppController {

	var $name = 'Tsubjects';

	function index() {
		$this->Tsubject->recursive = 0;
		$this->set('tsubjects', $this->paginate());
		parent::loguea($this->data,$this->here);
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid tsubject', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('tsubject', $this->Tsubject->read(null, $id));
		parent::loguea($this->data,$this->here);
	}

	function add() {
		if (!empty($this->data)) {
			$this->Tsubject->create();
			if ($this->Tsubject->save($this->data)) {
				parent::loguea($this->data,$this->here);
				$this->Session->setFlash(__('The tsubject has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The tsubject could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid tsubject', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Tsubject->save($this->data)) {
				parent::loguea($this->data,$this->here);
				$this->Session->setFlash(__('The tsubject has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The tsubject could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Tsubject->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for tsubject', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Tsubject->delete($id)) {
			parent::loguea($this->data,$this->here);
			$this->Session->setFlash(__('Tsubject deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Tsubject was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>
