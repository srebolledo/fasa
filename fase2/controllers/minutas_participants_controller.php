<?php
class MinutasParticipantsController extends AppController {

	var $name = 'MinutasParticipants';

	function index() {
		$this->MinutasParticipant->recursive = 0;
		$this->set('minutasParticipants', $this->paginate());
		parent::loguea($this->data,$this->here);
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid minutas participant', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('minutasParticipant', $this->MinutasParticipant->read(null, $id));
		parent::loguea($this->data,$this->here);
	}

	function add() {
		if (!empty($this->data)) {
			$this->MinutasParticipant->create();
			if ($this->MinutasParticipant->save($this->data)) {
				parent::loguea($this->data,$this->here);
				$this->Session->setFlash(__('The minutas participant has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The minutas participant could not be saved. Please, try again.', true));
			}
		}
		$minutas = $this->MinutasParticipant->Minutum->find('list');
		$participants = $this->MinutasParticipant->Participant->find('list');
		$this->set(compact('minutas', 'participants'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid minutas participant', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->MinutasParticipant->save($this->data)) {
				parent::loguea($this->data,$this->here);
				$this->Session->setFlash(__('The minutas participant has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The minutas participant could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->MinutasParticipant->read(null, $id);
		}
		$minutas = $this->MinutasParticipant->Minutum->find('list');
		$participants = $this->MinutasParticipant->Participant->find('list');
		$this->set(compact('minutas', 'participants'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for minutas participant', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->MinutasParticipant->delete($id)) {
			parent::loguea($this->data,$this->here);
			$this->Session->setFlash(__('Minutas participant deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Minutas participant was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>
