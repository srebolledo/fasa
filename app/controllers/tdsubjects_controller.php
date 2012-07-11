<?php
class TdsubjectsController extends AppController {

	var $name = 'Tdsubjects';

	function index() {
		$this->Tdsubject->recursive = 0;
		$this->set('tdsubjects', $this->paginate());
		parent::loguea($this->data,$this->here);
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid tdsubject', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('tdsubject', $this->Tdsubject->read(null, $id));
		parent::loguea($this->data,$this->here);
	}

	function add() {
		if (!empty($this->data)) {
			$this->Tdsubject->create();
			if ($this->Tdsubject->save($this->data)) {
				parent::loguea($this->data,$this->here);
				$this->Session->setFlash(__('The tdsubject has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The tdsubject could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid tdsubject', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Tdsubject->save($this->data)) {
				parent::loguea($this->data,$this->here);
				$this->Session->setFlash(__('The tdsubject has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The tdsubject could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Tdsubject->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for tdsubject', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Tdsubject->delete($id)) {
			parent::loguea($this->data,$this->here);
			$this->Session->setFlash(__('Tdsubject deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Tdsubject was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>
