<?php
class OnereporthistoriesController extends AppController {

	var $name = 'Onereporthistories';

	function index() {
		$this->Onereporthistory->recursive = 0;
		$this->set('onereporthistories', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid onereporthistory', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('onereporthistory', $this->Onereporthistory->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Onereporthistory->create();
			if ($this->Onereporthistory->save($this->data)) {
				$this->Session->setFlash(__('The onereporthistory has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The onereporthistory could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid onereporthistory', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Onereporthistory->save($this->data)) {
				$this->Session->setFlash(__('The onereporthistory has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The onereporthistory could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Onereporthistory->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for onereporthistory', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Onereporthistory->delete($id)) {
			$this->Session->setFlash(__('Onereporthistory deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Onereporthistory was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>