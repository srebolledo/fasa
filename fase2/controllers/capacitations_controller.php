<?php
class CapacitationsController extends AppController {

	var $name = 'Capacitations';
	

	function index() {
		$this->Capacitation->recursive = 0;
		$this->set('capacitations', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid capacitation', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('capacitation', $this->Capacitation->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Capacitation->create();
			if ($this->Capacitation->save($this->data)) {
				$this->Session->setFlash(__('The capacitation has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The capacitation could not be saved. Please, try again.', true));
			}
		}
		$relators = $this->Capacitation->Relator->find("list");
		$filials = $this->Capacitation->Filial->find('list',array('conditions'=>array('id<4')));
		
		$this->set(compact('filials','relators'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid capacitation', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Capacitation->save($this->data)) {
				$this->Session->setFlash(__('The capacitation has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The capacitation could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Capacitation->read(null, $id);
		}
		$filials = $this->Capacitation->Filial->find('list');
		$this->set(compact('filials'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for capacitation', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Capacitation->delete($id)) {
			$this->Session->setFlash(__('Capacitation deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Capacitation was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>
