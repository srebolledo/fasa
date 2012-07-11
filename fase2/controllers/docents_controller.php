<?php
class DocentsController extends AppController {

	var $name = 'Docents';



	function index() {
		$this->Docent->recursive = 0;
		$this->set('docents', $this->paginate());
		parent::loguea($this->data,$this->here);
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid docent', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('docent', $this->Docent->read(null, $id));
		parent::loguea($this->data,$this->here);
	}

	function add() {
		if (!empty($this->data)) {
			$this->Docent->create();
			if ($this->Docent->save($this->data)) {
				parent::loguea($this->data,$this->here);
				$this->Session->setFlash(__('The docent has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The docent could not be saved. Please, try again.', true));
			}
		}
		$emsefors = $this->Docent->Emsefor->find('list');
		$this->set(compact('emsefors'));
		parent::loguea($this->data,$this->here);
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid docent', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Docent->save($this->data)) {
				parent::loguea($this->data,$this->here);
				$this->Session->setFlash(__('The docent has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The docent could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Docent->read(null, $id);

		}
		$emsefors = $this->Docent->Emsefor->find('list');
		$this->set(compact('emsefors'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for docent', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Docent->delete($id)) {
			parent::loguea($this->data,$this->here);
			$this->Session->setFlash(__('Docent deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Docent was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>
