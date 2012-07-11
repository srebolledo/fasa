<?php
class EmseforsController extends AppController {

	var $name = 'Emsefors';


	function index() {
		$this->Emsefor->recursive = 0;
		
		$this->set('emsefors', $this->paginate());
		
		parent::loguea($this->data,$this->here);
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid emsefor', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('emsefor', $this->Emsefor->read(null, $id));
		parent::loguea($this->data,$this->here);
	}

	function add() {
		if (!empty($this->data)) {
			$this->Emsefor->create();
			if ($this->Emsefor->save($this->data)) {
				parent::loguea($this->data,$this->here);
				$this->Session->setFlash(__('The emsefor has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The emsefor could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid emsefor', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Emsefor->save($this->data)) {
				parent::loguea($this->data,$this->here);
				$this->Session->setFlash(__('The emsefor has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The emsefor could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Emsefor->read(null, $id);
			$unities = $this->Emsefor->Unity->find('list');
			$filials = $this->Emsefor->Filial->find('list');
			$this->set(compact('unities','filials'));
		}
	}
	
	function getName($id = null){
		if($id){
			$emsefor = $this->Emsefor->find("list",array("conditions"=>array("Emsefor.id"=>$id) ) ) ;

			foreach($emsefor as $e){
				return $e;			
			}


			
		}


	}

	function recodificar(){
		$data = $this->Emsefor->find("all");
		foreach($data as $d){
			$d["Emsefor"]["nombre"] = utf8_decode($d["Emsefor"]["nombre"]);
			$this->Emsefor->save($d);
		}


		exit();
		}


	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for emsefor', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Emsefor->delete($id)) {
			parent::loguea($this->data,$this->here);
			$this->Session->setFlash(__('Emsefor deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Emsefor was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function buscar(){
		if($this->data){
			$this->redirect(array('action'=>'view',$this->data['Emsefor']['emsefor_id']));
		}
		$this->set('title_for_layout','Sistema de reportes | Buscar EMSEFOR');
		$usuario = $this->Session->read('Auth.User');
		$this->loadModel('Engineer');
		$this->Engineer->recursive=0;
		$usuario = $this->Engineer->find('all',array('conditions'=>array('Engineer.user_id'=>$usuario['id'])));
		if($usuario[0]['User']['group_id'] !=1){
		$filial = $usuario[0]['Engineer']['filial_id'] - 5;
		$this->Emsefor->recursive = 0;
		$conditions = array('Emsefor.filial_id'=>$filial);
		$this->set('emsefors', $this->paginate('Emsefor',$conditions));
		}
		else{
		$this->set('emsefors', $this->paginate('Emsefor'));
		}
		parent::loguea($this->data,$this->here);
	
	
	
	}
	function getEmsefor(){
		$this->layout = "ajax";
		$this->autoRender = false;
		$user = $this->Session->read("Auth.User");
		if ( $this->RequestHandler->isAjax() ) {
			//$st = $_GET["q"];
			$st = $_GET["term"];
			if($user["group_id"] == 2){
				
				$emsefors = $this->Onereport->Emsefor->find("list", array("conditions"=>array("Emsefor.filial_id"=>$filial,"Emsefor.id >"=>1000,"Emsefor.nombre LIKE '%".$st."%'")));
			}
			else{	
				$usuario = $this->Session->read('Auth.User');
				$this->loadModel('Engineer');
				$this->Engineer->recursive=-1;
				$usuario = $this->Engineer->find('all',array('conditions'=>array('Engineer.user_id'=>$usuario['id'])));
				$filial = $usuario[0]['Engineer']['filial_id'] - 6;
				$this->Emsefor->recursive=-1;
				$emsefors = $this->Emsefor->find("list",array("conditions"=>array("Emsefor.filial_id >"=>$filial,"Emsefor.nombre LIKE '%".$st."%'")));
			}
			$i = 0;
			foreach($emsefors as $key =>$e){
				$response[$i]["id"] = $key;
				$response[$i]["value"] = $e; 
				$i++;
			}
			echo json_encode($response);
		}		
	}
	function info(){
		$this->set('title_for_layout','Sistema de reportes | Buscar EMSEFOR');
		$usuario = $this->Session->read('Auth.User');
		$this->loadModel('Engineer');
		$this->Engineer->recursive=-1;
		$usuario = $this->Engineer->find('all',array('conditions'=>array('Engineer.user_id'=>$usuario['id'])));
		$filial = $usuario[0]['Engineer']['filial_id'] - 5;
		$this->Emsefor->recursive = 0;
		$conditions = array('Emsefor.filial_id'=>$filial);
		$this->set('emsefors', $this->paginate('Emsefor',$conditions));
		
		parent::loguea($this->data,$this->here);
	
	
		
	
	}

	
	
	
}
?>
