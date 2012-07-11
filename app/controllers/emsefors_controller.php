<?php
class EmseforsController extends AppController {

	var $name = 'Emsefors';


	function index() {
		$this->Emsefor->recursive = 0;
		
		$this->set('emsefors', $this->paginate());
		
		parent::loguea($this->data,$this->here);
	}

	function view($id = null) {
		$this->set('title_for_layout','Sistema de reportes | Información de EMSEFOR');
		if (!$id) {
			$this->Session->setFlash(__('Invalid emsefor', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('emsefor', $this->Emsefor->read(null, $id));
		$this->loadModel('Onereport');
		$this->loadModel('Engineers');
		$this->set('indicators',$this->Onereport->Indicator->find('list'));
		$this->set('ideasstates',$this->Onereport->Ideasstate->find('list'));
		$this->set('cartastates',$this->Onereport->Cartastate->find('list'));
		$this->set('proyectostates',$this->Onereport->Proyectostate->find('list'));
		$this->Onereport->Engineer->recursive = -1;
		$engineers = $this->Onereport->Engineer->find('all',array('conditions'=>array('Engineer.filial_id<=3')));
		$engineersA = array();
		foreach($engineers as $key=>$value){
			$engineersA[$value['Engineer']['id']] = $value;
		
		}
		
		$this->set('engineers',$engineersA);
		parent::loguea($this->data,$this->here);
	}

	function add() {
		$this->set('title_for_layout','Sistema de reportes | Agregar nueva EMSEFOR');
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
		$this->loadModel('Engineer');
		$user = $this->Session->read('Auth.User');
		if($user['group_id']==4){
			$this->Engineer->recursive = -1;
			$profile = $this->Engineer->find('all',array('conditions'=>array('user_id'=>$user['id'])));
			$this->set('filialIngeniero',$profile[0]['Engineer']['filial_id']-5);
		}
		
		$this->set('filials',$this->Emsefor->Filial->find('list',array('conditions'=>array('id<=3') )));
		$this->set('unities',$this->Emsefor->Unity->find('list'));
		
		
		
	}

	function edit($id = null) {
		$this->set('title_for_layout','Sistema de reportes | Editar una EMSEFOR');
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
		$this->set('title_for_layout','Sistema de reportes | Buscar EMSEFOR');
		$usuario = $this->Session->read('Auth.User');
		$this->loadModel('Engineer');
		$this->Engineer->recursive=0;
		$usuario = $this->Engineer->find('all',array('conditions'=>array('Engineer.user_id'=>$usuario['id'])));
		$conditions = array();
		if($usuario[0]['User']['group_id'] !=1){
		$filial = $usuario[0]['Engineer']['filial_id'] - 5;
		$this->Emsefor->recursive = 0;
		$conditions['Emsefor.filial_id'] = $filial;
		if($this->data['Emsefor']['lugar'] != '') array_push($conditions,array('Emsefor.lugar'=>$this->data['Emsefor']['lugar']));
		$this->set('emsefors', $this->paginate('Emsefor',$conditions));
		}
		else{
			if($this->data['Emsefor']['lugar'] != '') $conditions['Emsefor.lugar']=$this->data['Emsefor']['lugar'];
			$this->set('emsefors', $this->paginate('Emsefor',$conditions));
		}
		if($this->data['Emsefor']['emsefor_id'] != ''){
	
			$this->redirect(array('action'=>'view',$this->data['Emsefor']['emsefor_id']));
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
				$this->Emsefor->recursive=0;
				$emsefors = $this->Emsefor->find("all",array("conditions"=>array("Emsefor.filial_id >"=>$filial,"Emsefor.nombre LIKE '%".$st."%'")));
			}
			$i = 0;
			foreach($emsefors as $key =>$e){
					$response[$i]["id"] = $e['Emsefor']['id'];
					$response[$i]["value"] = $e['Emsefor']['nombre'	]." (".$e['Filial']['nombre'].")";
					$i++;

			}
			echo json_encode($response);
		}		
	}
	function info(){
		$this->autoRender = false;
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
	
	function descarga(){
		App::import('Vendor','PHPExcel',array('file' => 'excel/PHPExcel.php'));
		App::import('Vendor','PHPExcelWriter',array('file' => 'excel/PHPExcel/Writer/Excel5.php'));
		$this->loadModel('Engineer');
		$xls = new PHPExcel();
		$this->set('xls',$xls);
		$conditions = array();
		$usuario = $this->Session->read('Auth.User');
		if($usuario['group_id'] == 3){ //all reports
			$this->Emsefor->recursive = 0;
			$this->set('emsefors',$this->Emsefor->find('all'));
		
		}
		else if($usuario['group_id'] == 4){
			$this->Engineer->recursive = -1;
			$engineer = $this->Engineer->find('all',array('conditions'=>array('user_id'=>$usuario['id'])));
			$this->Emsefor->recursive =0;
			$this->set('emsefors',$this->Emsefor->find('all',array('conditions'=>array('filial_id'=>$engineer[0]['Engineer']['filial_id']-5))));
			
		}
		$this->set('nombreArchivo','Emsefors');
		$this->layout='ajax';
	}
	
	
	
}
?>
