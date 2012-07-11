<?php
class MinutasController extends AppController {

	var $name = 'Minutas';
	var $uses = array('Minuta','Tworeport');

	function index() {
		$this->Minuta->recursive = 0;
		$this->set('minutas', $this->paginate());
		parent::loguea($this->data,$this->here);
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid minuta', true));
			$this->redirect(array('action' => 'index'));
			parent::loguea($this->data,$this->here);
		}
		$this->set('minuta', $this->Minuta->read(null, $id));
	}

	function add($id = null) {
		if (!empty($this->data)) {
			$this->Minuta->create();
			if ($this->Minuta->save($this->data)) {
				parent::loguea($this->data,$this->here);
				$reporte = $this->Tworeport->read(null,$this->data['Minuta']['tworeport_id']);
				$reporte["Tworeport"]["state_id"] = 2;
				$this->Tworeport->save($reporte);				
				$this->Session->setFlash(__('La minuta ha sido guardada con éxito', true));
				$this->redirect(array('controller'=>'tworeports','action' => 'abiertas'));				
				if($this->Session->read("Auth.User")){
					
				}
				else{
					$this->redirect(array('action' => 'index'));				
				}
			} else {
				$this->Session->setFlash(__('Ha ocurrido un error, si persiste consulte con el administrador.', true));
			}
		}
		if(!$id){
			echo "Imposible agregar minuta";

		}
		else{	
			/*
			1	Planificada
			2	Realizada
			3	No realizada
			4	Replanificada
			*/
			/*$this->Tworeport->find("all",);
			$this->Tworeport->recursive = 0;*/
			$this->set('id_reporte',$id);
			
		}
	}

	function verabiertas(){
		


	}


	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid minuta', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Minuta->save($this->data)) {
				parent::loguea($this->data,$this->here);
				$this->Session->setFlash(__('The minuta has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The minuta could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Minuta->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for minuta', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Minuta->delete($id)) {
			parent::loguea($this->data,$this->here);
			$this->Session->setFlash(__('Minuta deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Minuta was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>
