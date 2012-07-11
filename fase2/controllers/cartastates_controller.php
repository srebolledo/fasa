<?php
class CartastatesController extends AppController {

	var $name = 'Cartastates';



	function index() {
		$this->Cartastate->recursive = 0;
		$this->set('cartastates', $this->paginate());
		parent::loguea($this->data,$this->here);
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid cartastate', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('cartastate', $this->Cartastate->read(null, $id));
		parent::loguea($this->data,$this->here);
	}

	function add() {
		if (!empty($this->data)) {
			$this->Cartastate->create();
			if ($this->Cartastate->save($this->data)) {
				parent::loguea($this->data,$this->here);
				$this->Session->setFlash(__('The cartastate has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The cartastate could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid cartastate', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Cartastate->save($this->data)) {
				parent::loguea($this->data,$this->here);
				$this->Session->setFlash(__('The cartastate has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The cartastate could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Cartastate->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for cartastate', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Cartastate->delete($id)) {
			parent::loguea($this->data,$this->here);
			$this->Session->setFlash(__('Cartastate deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Cartastate was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>
