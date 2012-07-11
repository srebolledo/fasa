<?php
class EngineersController extends AppController {

	var $name = 'Engineers';


	function index() {
		$this->Engineer->recursive = 0;
		$this->set('engineers', $this->paginate());
		parent::loguea($this->data,$this->here);
	}
	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid engineer', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('engineer', $this->Engineer->read(null, $id));
		parent::loguea($this->data,$this->here);
	}

	function add() {
		if (!empty($this->data)) {
			$this->Engineer->create();
			if ($this->Engineer->save($this->data)) {
				parent::loguea($this->data,$this->here);
				$this->Session->setFlash(__('The engineer has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The engineer could not be saved. Please, try again.', true));
			}
		}
		$users = $this->Engineer->User->find("list");
		$filials = $this->Engineer->Filial->find('list');
		$this->set(compact('filials','users'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid engineer', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Engineer->save($this->data)) {
				parent::loguea($this->data,$this->here);
				$this->Session->setFlash(__('The engineer has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The engineer could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Engineer->read(null, $id);
		}
		$users = $this->Engineer->User->find("list");
		$filials = $this->Engineer->Filial->find('list');
		$this->set(compact('filials','users'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for engineer', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Engineer->delete($id)) {
			parent::loguea($this->data,$this->here);
			$this->Session->setFlash(__('Engineer deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Engineer was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}

	//Funciones que retornan cosas
	function getId($id =null){
		if($id){
			$key = $this->Engineer->find("list",array("conditions"=>array("Engineer.user_id"=>$id)));
			$keys = array_keys($key);
			return $keys[0];
		}
	}
	function getList(){
		$this->render(false);
		return $this->Engineer->find("list",array("conditions"=>array("Engineer.filial_id <>"=>5)));
		
	}
	function getName($id=null){
		$this->autoRender = false;
		if($id){
			$engineer = $this->Engineer->find("list",array("conditions"=>array("Engineer.id"=>$id),"fields"=>array("Engineer.nombre","Engineer.apellido","Engineer.id") ) ) ;
			foreach($engineer as $e){
				foreach($e as $key=>$value){
					return $key." ".$value;
				}
			}

			
		}
	}

	
}
?>
