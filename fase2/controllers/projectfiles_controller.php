<?php
class ProjectfilesController extends AppController {

	var $name = 'Projectfiles';

	function index() {
		$this->Projectfile->recursive = 0;
		$this->set('projectfiles', $this->paginate());
		parent::loguea($this->data,$this->here);
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid projectfile', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('projectfile', $this->Projectfile->read(null, $id));
		parent::loguea($this->data,$this->here);
	}

	function add() {
		if (!empty($this->data)) {
			$this->Projectfile->create();
			if ($this->Projectfile->save($this->data)) {
				parent::loguea($this->data,$this->here);
				$this->Session->setFlash(__('The projectfile has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The projectfile could not be saved. Please, try again.', true));
			}
		}
		$projects = $this->Projectfile->Project->find('list');
		$this->set(compact('projects'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid projectfile', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Projectfile->save($this->data)) {
				parent::loguea($this->data,$this->here);
				$this->Session->setFlash(__('The projectfile has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The projectfile could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Projectfile->read(null, $id);
		}
		$projects = $this->Projectfile->Project->find('list');
		$this->set(compact('projects'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for projectfile', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Projectfile->delete($id)) {
			parent::loguea($this->data,$this->here);
			$this->Session->setFlash(__('Projectfile deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Projectfile was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>
