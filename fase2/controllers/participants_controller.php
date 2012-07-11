<?php
class ParticipantsController extends AppController {

	var $name = 'Participants';

	function index() {
		$this->Participant->recursive = 0;
		$this->set('participants', $this->paginate());
		parent::loguea($this->data,$this->here);
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid participant', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('participant', $this->Participant->read(null, $id));
		parent::loguea($this->data,$this->here);
	}

	function add() {
		if (!empty($this->data)) {
			$this->Participant->create();
			if ($this->Participant->save($this->data)) {
				$this->Session->setFlash(__('The participant has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The participant could not be saved. Please, try again.', true));
			}
		}
		$positions = $this->Participant->Position->find('list');
		$minutas = $this->Participant->Minuta->find('list');
		$this->set(compact('positions', 'minutas'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid participant', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Participant->save($this->data)) {
				parent::loguea($this->data,$this->here);
				$this->Session->setFlash(__('The participant has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The participant could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Participant->read(null, $id);
		}
		$positions = $this->Participant->Position->find('list');
		$minutas = $this->Participant->Minuta->find('list');
		$this->set(compact('positions', 'minutas'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for participant', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Participant->delete($id)) {
			parent::loguea($this->data,$this->here);
			$this->Session->setFlash(__('Participant deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Participant was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>
