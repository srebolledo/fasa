<?php
class CapasistsController extends AppController {

	var $name = 'Capasists';

	function index() {
		$this->Capasist->recursive = 0;
		$this->set('capasists', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid capasist', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('capasist', $this->Capasist->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Capasist->create();
			if ($this->Capasist->save($this->data)) {
				$this->Session->setFlash(__('The capasist has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The capasist could not be saved. Please, try again.', true));
			}
		}
		$emsefors = $this->Capasist->Emsefor->find('list');
		$capacitations = $this->Capasist->Capacitation->find('list');
		$this->set(compact('emsefors', 'capacitations'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid capasist', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Capasist->save($this->data)) {
				$this->Session->setFlash(__('The capasist has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The capasist could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Capasist->read(null, $id);
		}
		$emsefors = $this->Capasist->Emsefor->find('list');
		$capacitations = $this->Capasist->Capacitation->find('list');
		$this->set(compact('emsefors', 'capacitations'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for capasist', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Capasist->delete($id)) {
			$this->Session->setFlash(__('Capasist deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Capasist was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>