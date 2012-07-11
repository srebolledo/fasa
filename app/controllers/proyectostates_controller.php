<?php
class ProyectostatesController extends AppController {

	var $name = 'Proyectostates';

	function index() {
		$this->Proyectostate->recursive = 0;
		$this->set('proyectostates', $this->paginate());
		parent::loguea($this->data,$this->here);
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid proyectostate', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('proyectostate', $this->Proyectostate->read(null, $id));
		parent::loguea($this->data,$this->here);
	}

	function add() {
		if (!empty($this->data)) {
			$this->Proyectostate->create();
			if ($this->Proyectostate->save($this->data)) {
				parent::loguea($this->data,$this->here);
				$this->Session->setFlash(__('The proyectostate has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The proyectostate could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid proyectostate', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Proyectostate->save($this->data)) {
				parent::loguea($this->data,$this->here);
				$this->Session->setFlash(__('The proyectostate has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The proyectostate could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Proyectostate->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for proyectostate', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Proyectostate->delete($id)) {
			parent::loguea($this->data,$this->here);
			$this->Session->setFlash(__('Proyectostate deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Proyectostate was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>
