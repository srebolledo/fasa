<?php
class FilialsController extends AppController {

	var $name = 'Filials';



	function index() {
		$this->Filial->recursive = 0;
		$this->set('filials', $this->paginate());
		parent::loguea($this->data,$this->here);
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid filial', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('filial', $this->Filial->read(null, $id));
		parent::loguea($this->data,$this->here);
	}

	function add() {
		if (!empty($this->data)) {
			$this->Filial->create();
			if ($this->Filial->save($this->data)) {
				parent::loguea($this->data,$this->here);
				$this->Session->setFlash(__('The filial has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The filial could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid filial', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Filial->save($this->data)) {
				parent::loguea($this->data,$this->here);
				$this->Session->setFlash(__('The filial has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The filial could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Filial->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for filial', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Filial->delete($id)) {
			parent::loguea($this->data,$this->here);
			$this->Session->setFlash(__('Filial deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Filial was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function getName($id){
		if($id){
			$emsefor = $this->Filial->find("list",array("conditions"=>array("Filial.id"=>$id) ) ) ;

			foreach($emsefor as $e){

				return $e;			
			}


			
		}
	}
}
?>
