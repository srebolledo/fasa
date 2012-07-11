<?php
class ProjecttypesController extends AppController {

	var $name = 'Projecttypes';

	function index() {
		$this->Projecttype->recursive = 0;
		$this->set('projecttypes', $this->paginate());
		parent::loguea($this->data,$this->here);
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid projecttype', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('projecttype', $this->Projecttype->read(null, $id));
		parent::loguea($this->data,$this->here);
	}

	function add() {
		if (!empty($this->data)) {
			$this->Projecttype->create();
			if ($this->Projecttype->save($this->data)) {
				parent::loguea($this->data,$this->here);
				$this->Session->setFlash(__('The projecttype has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The projecttype could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid projecttype', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Projecttype->save($this->data)) {
				parent::loguea($this->data,$this->here);
				$this->Session->setFlash(__('The projecttype has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The projecttype could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Projecttype->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for projecttype', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Projecttype->delete($id)) {
			parent::loguea($this->data,$this->here);
			$this->Session->setFlash(__('Projecttype deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Projecttype was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>
