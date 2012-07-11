<?php
class RelatorsController extends AppController {

	var $name = 'Relators';

	function index() {
		$this->Relator->recursive = 0;
		$this->set('relators', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid relator', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('relator', $this->Relator->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Relator->create();
			if ($this->Relator->save($this->data)) {
				$this->Session->setFlash(__('The relator has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The relator could not be saved. Please, try again.', true));
			}
		}
		$capacitations = $this->Relator->Capacitation->find('list');
		$this->set(compact('capacitations'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid relator', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Relator->save($this->data)) {
				$this->Session->setFlash(__('The relator has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The relator could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Relator->read(null, $id);
		}
		$capacitations = $this->Relator->Capacitation->find('list');
		$this->set(compact('capacitations'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for relator', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Relator->delete($id)) {
			$this->Session->setFlash(__('Relator deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Relator was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>