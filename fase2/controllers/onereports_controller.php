<?php

class OnereportsController extends AppController {

	var $name = 'Onereports';
	var $uses = array("Onereport","Engineer","Emsefor","Filial","Projectfile",'Businessstate','Log');
	var $helpers = array("Ajax");	
	
	function index() {
		$usuario = $this->Session->read('Auth.User');
		$this->set('title_for_layout','Sistema de reportes | Registro de ideas');
		if($this->data){
			
			parent::loguea($this->data,$this->here);
			$conditions = array();
			if($this->data["Onereport"]["ingeniero"]!= 0){
				$conditions["Onereport.engineer_id"] = $this->data["Onereport"]["ingeniero"];
			}
			if($this->data["Onereport"]["emsefor_id"]!= 0){
				$conditions["Onereport.emsefor_id"] = $this->data["Onereport"]["emsefor_id"];
			}
			if($this->data["Onereport"]["indicator"] != 0){
				$conditions["Onereport.indicator_id"] = $this->data["Onereport"]["indicator"];
			}
			if($this->data["Onereport"]["idea"] != 0){
				$conditions["Onereport.ideasstate_id"]=$this->data["Onereport"]["idea"];
			}
			if($this->data["Onereport"]["carta"] != 0){
				$conditions["Onereport.cartastate_id"]=$this->data["Onereport"]["carta"];
			}
			if($this->data["Onereport"]["proyecto"] != 0){
				$conditions["Onereport.proyectostate_id"]=$this->data["Onereport"]["proyecto"];
			}
			if($this->data['Onereport']['unity'] != 0){
				$conditions["Onereport.unity_id"]=$this->data["Onereport"]["unity"];
			}
		}


		$this->Onereport->recursive = 0;
		if(isset($conditions) && count($conditions)>0){
			$this->set('onereports', $this->Onereport->find("all",array("conditions"=>$conditions) ) );
			$this->set("pagina" , false);
		}
		else{
			if($usuario['group_id'] == 4){
				$conditions = array();
				$user = $this->Engineer->find('all',array('conditions'=>array('user_id'=>$usuario['id'])));
				$filialIngeniero=$user[0]['Filial']['id']-5;
				$filialIngeniero = $this->Engineer->find('list',array('conditions'=>array('filial_id'=>$filialIngeniero)));
				$conditions['Onereport.engineer_id'] = array();
				foreach($filialIngeniero as $key=>$value){
					array_push($conditions['Onereport.engineer_id'],$key);
				}
				$this->set('onereports', $this->paginate('Onereport',$conditions));
			}
			else{
						$this->set('onereports', $this->paginate());
			}		

			$this->set("pagina" ,true);
		}
		if($usuario['group_id'] == 4){
				$usuario = $this->Engineer->find('all',array('conditions'=>array('user_id'=>$usuario['id'])));
				$filialIngeniero=$usuario[0]['Filial']['id']-5;
				$filialIngeniero = $this->Engineer->find('list',array('conditions'=>array('filial_id'=>$filialIngeniero)));
				$conditions = array();
				$conditions['Onereport.engineer_id'] = array();
				foreach($filialIngeniero as $key=>$value){
					array_push($conditions['Onereport.engineer_id'],$key);
				}
		$engineer = $this->Onereport->Engineer->find("list",array("conditions"=>array("Engineer.filial_id<=3",'Engineer.id'=>$conditions['Onereport.engineer_id'])));
		}
		else{
		$engineer = $this->Onereport->Engineer->find("list",array("conditions"=>array("Engineer.filial_id<=3")));
		}
		
		$indicator = $this->Onereport->Indicator->find("list");
		$idea = $this->Onereport->Ideasstate->find("list");
		$carta = $this->Onereport->Cartastate->find("list");
		$proyecto = $this->Onereport->Proyectostate->find("list");
		$unity = $this->Onereport->Unity->find('list');
		foreach($engineer as $key=>&$e){
			$e = $this->requestAction("/engineers/getName/".$key);
		}
		$engineer[0] = "Seleccione Ingeniero";
		$indicator[0] = "Seleccione actividad";
		$idea[0] = "Seleccione estado de idea";
		$carta[0] = "Seleccione estado de la carta";
		$proyecto[0] = "Seleccione estado del proyecto";
		$unity[0] = 'Seleccione una unidad';
		$this->set("engineer", $engineer);
		$this->set("indicator", $indicator);
		$this->set("idea",$idea);
		$this->set("carta",$carta);
		$this->set("proyecto",$proyecto);
		$this->set('unity',$unity);
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
				$this->Onereport->Engineer->recursive = 0;
				$ing = $this->Onereport->Engineer->find('all',array('conditions'=>array("Engineer.user_id" => $user["id"])));
				$filial= $ing[0]["Engineer"]["filial_id"];
				$emsefors = $this->Onereport->Emsefor->find("list", array("conditions"=>array("Emsefor.filial_id"=>$filial,"Emsefor.id >"=>1000,"Emsefor.nombre LIKE '%".$st."%'")));
			}
			else{	
				$ing = 	$this->Onereport->Engineer->find("all");	
				$emsefors = $this->Onereport->Emsefor->find("list",array("conditions"=>array("Emsefor.id >"=>1000,"Emsefor.nombre LIKE '%".$st."%'")));
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

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid onereport', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->loadModel('Onereporthistory');
		$this->Onereporthistory->recursive=-1;
		$this->set('ideasstate',$this->Onereport->Ideasstate->find('list'));
		$this->set('cartastate',$this->Onereport->Cartastate->find('list'));
		$this->set('proyectostate',$this->Onereport->Proyectostate->find('list'));
		$this->set('businessstate',$this->Onereport->Businessstate->find('list'));
		$this->set('onereport', $this->Onereport->read(null, $id));
		$this->set('onereporthistory',$this->Onereporthistory->find('all',array('conditions'=>array('onereport_id'=>$id),'order'=>'created desc' )));
		$this->set('title_for_layout','Sistema de reportes | Registro de ideas | viendo idea '.$id);
		parent::loguea($this->data,$this->here);
	}

	function add() {
				$this->set('title_for_layout','Sistema de reportes | Registro de ideas | Agregar nueva idea');
		if (!empty($this->data)) {
			$this->data["Onereport"]["cartastate_id"] = 3;
			$this->data["Onereport"]["proyectostate_id"] = 5;
			$this->Onereport->create();
			$this->Onereport->order = "Onereport.correlativoidea DESC";
			$first = $this->Onereport->find("first",array("conditions"=>array("Onereport.engineer_id"=>$this->data["Onereport"]["engineer_id"])));
			if($first["Onereport"]["correlativoidea"] != 0){
				$this->data["Onereport"]["correlativoidea"] = $first["Onereport"]["correlativoidea"]+1;
			}
			else{
				$this->data["Onereport"]["correlativoidea"]=1;
			}
			if($this->data["Onereport"]["folio"] == ""){
				$this->data["Onereport"]["folio"] = 0;
			}
			if($this->data["Onereport"]["sap"] == ""){
				$this->data["Onereport"]["sap"] = 0;
			}
			if($this->data["Onereport"]["ideasstate_id"]==1){
				$this->data["Onereport"]["proyectofecha"] = 0;
				$this->data["Onereport"]["proyectofechafin"] = 0;
			}
			if ($this->Onereport->save($this->data,array("validate"=>false))) {
				parent::loguea($this->data,$this->here);
				$this->Session->setFlash(__('The onereport has been saved', true));
				$usuario = $this->Session->read('Auth.User');
				if($usuario['group_id'] == 2){
						$this->redirect(array('action'=>'abiertas'));
				}
				else{
					$this->redirect(array('action' => 'index'));
				}
			} else {
				$this->Session->setFlash(__('The onereport could not be saved. Please, try again.', true));
			}
		}

		
		$indicators = $this->Onereport->Indicator->find('list');
		$ideasstates = $this->Onereport->Ideasstate->find('list');
		$cartastates = $this->Onereport->Cartastate->find('list');
		$proyectostates = $this->Onereport->Proyectostate->find('list');
    $businessstates = $this->Businessstate->find('list');
		$user = $this->Session->read("Auth.User");
		if($user["group_id"]!=1){
			$this->Onereport->Engineer->recursive = 0;
			//$engineers = $this->Onereport->Engineer->find('all',array('conditions'=>array("Engineer.user_id" => $user["id"])));
			$ing = $this->Onereport->Engineer->find('all',array('conditions'=>array("Engineer.user_id" => $user["id"])));
			$filial= $ing[0]["Engineer"]["filial_id"];
			$emsefors = $this->Onereport->Emsefor->find("list", array("conditions"=>array("Emsefor.filial_id"=>$filial,"Emsefor.id >"=>1000)));

		}
		else{	
			$ing = 	$this->Onereport->Engineer->find("all");	
			$emsefors = $this->Onereport->Emsefor->find("list");
		}

		$engineers = array();		
		foreach($ing as $i){
			$engineers[$i["Engineer"]["id"]] = $i["Engineer"]["nombre"]." ".$i["Engineer"]["apellido"];
		}
		
		$emsefor = array();
		foreach($emsefors as $key =>$value){
			$emsefor[$key] = utf8_encode($value);
		}
		$emsefors = $emsefor;
		$unities = $this->Onereport->Unity->find("list");
		//$emsefors = $this->Onereport->Emsefor->find("list");		
		$positions = $this->Onereport->Position->find("list",array("conditions"=>array("Position.id >"=>1000)));
		$this->set(compact('indicators', 'ideasstates', 'cartastates', 'proyectostates', 'projecttypes', 'tworeports',"engineers","unities","emsefors","positions",'businessstates'));
		
	}

	function edit($id = null) {

		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid onereport', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if($this->data["Onereport"]["proyectostate_id"] == 5 ){
				$this->data["Onereport"]["proyectofecha"]["year"] = 0000;
				$this->data["Onereport"]["proyectofecha"]["month"] = 00;
				$this->data["Onereport"]["proyectofecha"]["day"] = 00;
				$this->data["Onereport"]["proyectofechafin"]["year"] = 0000;
				$this->data["Onereport"]["proyectofechafin"]["month"] = 00;
				$this->data["Onereport"]["proyectofechafin"]["day"] = 00;


			}
			if($this->data["Onereport"]["proyectostate_id"] != 3){
				$this->data["Onereport"]["proyectofechafin"]["year"] = 0000;
				$this->data["Onereport"]["proyectofechafin"]["month"] = 00;
				$this->data["Onereport"]["proyectofechafin"]["day"] = 00;


			}
			if ($this->Onereport->save($this->data,false)) {
				parent::loguea($this->data,$this->here);
				$this->Session->setFlash(__('La idea ha sido guardada', true));
				$usuario = $this->Session->read('Auth.User');
				if($usuario['group_id'] == 2){
						$this->redirect(array('action'=>'abiertas'));
				}
				else{
					$this->redirect(array('action' => 'index'));
				}
			} else {
				$this->Session->setFlash(__('La idea no se ha registrado. Intente nuevamente', true));
			}
		}
		if (empty($this->data)) {
			$this->set('title_for_layout','Sistema de reportes | Registro de ideas | Editando idea '.$id);
			$this->data = $this->Onereport->read(null, $id);
			$this->set("emsefors_id",$this->data["Onereport"]["emsefor_id"]);
		}
		
		$engineers = $this->Onereport->Engineer->find("list");
		$unities  = $this->Onereport->Unity->find("list");
		$emsefors = $this->Onereport->Emsefor->find("list");
		$positions = $this->Onereport->Position->find("list");
		$indicators = $this->Onereport->Indicator->find('list');
		$ideasstates = $this->Onereport->Ideasstate->find('list');
		$cartastates = $this->Onereport->Cartastate->find('list');
		$proyectostates = $this->Onereport->Proyectostate->find('list');
		//$projecttypes = $this->Onereport->Projecttype->find('list');
		//$tworeports = $this->Onereport->Tworeport->find('list');
		$this->set(compact('indicators', 'ideasstates', 'cartastates', 'proyectostates','engineers','unities','emsefors','positions'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for onereport', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Onereport->delete($id)) {
			parent::loguea($this->data,$this->here);
			$this->Session->setFlash(__('Idea borrada con éxito.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Onereport was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}

	


	function setStats($idUsuario = null,$ing = null){
		if($this->Session->read("Auth.User")){
			if(!$ing){
				$usuario["id"]=$idUsuario;
				
			}
			if($ing!=null){
				$usuario["id"]=$ing;

			}
			$ideas = $this->Onereport->find("count",array("conditions"=>array("Onereport.engineer_id"=>$usuario["id"])));
			$ideasAprobadas = $this->Onereport->find("count",array("conditions"=>array("Onereport.engineer_id"=>$usuario["id"],"Onereport.ideasstate_id"=>2)));
			$ideasRechazadas = $this->Onereport->find("count",array("conditions"=>array("Onereport.engineer_id"=>$usuario["id"],"Onereport.ideasstate_id"=>3)));
			$ideasPendientes = $this->Onereport->find("count",array("conditions"=>array("Onereport.engineer_id"=>$usuario["id"],"Onereport.ideasstate_id"=>1)));
			$ideasReproceso = $this->Onereport->find("count",array("conditions"=>array("Onereport.engineer_id"=>$usuario["id"],"Onereport.ideasstate_id"=>4)));
			
			$proyectoPendiente = $this->Onereport->find("count",array("conditions"=>array("Onereport.engineer_id"=>$usuario["id"],"Onereport.proyectostate_id"=>1)));
			$proyectoRechazado = $this->Onereport->find("count",array("conditions"=>array("Onereport.engineer_id"=>$usuario["id"],"Onereport.proyectostate_id"=>4)));
			$proyectoEvaluacion = $this->Onereport->find("count",array("conditions"=>array("Onereport.engineer_id"=>$usuario["id"],"Onereport.proyectostate_id"=>2)));
			$proyectoAprobado = $this->Onereport->find("count",array("conditions"=>array("Onereport.engineer_id"=>$usuario["id"],"Onereport.proyectostate_id"=>3)));		

			return array("ideas"=>$ideas,"ideasAprobadas"=>$ideasAprobadas,"ideasRechazadas"=>$ideasRechazadas,"ideasPendientes"=>$ideasPendientes,"ideasReproceso"=>$ideasReproceso,"proyectoPendiente"=>$proyectoPendiente,"proyectoRechazado"=>$proyectoRechazado,"proyectoEvaluacion"=>$proyectoEvaluacion,"proyectoAprobado"=>$proyectoAprobado);
			
			
		}

	}
	function ver($id=null){
		$this->set("pagina",false);
		if($this->Session->read("Auth.User")){
			$usuario = $this->Session->read("Auth.User");	
			$engineer = $this->requestAction("/engineers/getId/".$usuario["id"]);
			if($usuario["group_id"] == 2){
				$this->Onereport->recursive = 0;
				$conditions = array();
				$conditions["Onereport.engineer_id"] = $engineer;
				//$this->set('onereports', $this->paginate());
				if($this->data){
					$conditions = array();
					$conditions["Onereport.engineer_id"] = $engineer;
					//if($this->data["Onereport"]["ingeniero"]!= 0){
						//$conditions["Onereport.engineer_id"] = $engineer;
					//}
					if($this->data["Onereport"]["emsefor_id"] != 0){
						$conditions["Onereport.emsefor_id"] = $this->data["Onereport"]["emsefor_id"];

					}
					if($this->data["Onereport"]["indicator"] != 0){
						$conditions["Onereport.indicator_id"] = $this->data["Onereport"]["indicator"];
					}
					if($this->data["Onereport"]["carta"] != 0){
						$conditions["Onereport.cartastate_id"]=$this->data["Onereport"]["carta"];
					}
					if($this->data["Onereport"]["proyecto"] != 0){
						$conditions["Onereport.proyectostate_id"]=$this->data["Onereport"]["proyecto"];
					}
					if($this->data['Onereport']['unity'] != 0){
						$conditions["Onereport.unity_id"]=$this->data["Onereport"]["unity"];
					}
				}
				if($id != null &&($id == 1 ||$id == 2 ||$id == 3 ||$id == 4 ||$id == 5 )){
					$conditions["Onereport.ideasstate_id"]=$id;
					switch($id){
						case 1:
							$this->set('title_for_layout','Sistema de reportes | Registro de ideas | Ideas pendientes');
							break;
					
						case 2:
							$this->set('title_for_layout','Sistema de reportes | Registro de ideas | Ideas aprobadas');
							break;
						case 3:
							$this->set('title_for_layout','Sistema de reportes | Registro de ideas | Ideas rechazadas');
							break;
						case 4:
							$this->set('title_for_layout','Sistema de reportes | Registro de ideas | Ideas reproceso');
							break;
					}
				}
				else{
						$this->set('title_for_layout','Sistema de reportes | Registro de ideas | Todas');
				}
				
				
				
				
				//$this->Onereport->recursive = 1;
				/*if(isset($conditions) && count($conditions)>0){
					$onereports = $this->Onereport->find("all",array("conditions"=>$conditions,'order'=>'Onereport.fecha desc') );
					foreach($onereports as &$onereport){
						if(isset($onereport["Project"]["id"])){
							$this->Onereport->Project->Projectfile->recursive = -1;
							$onereport["Projectfile"] = $this->Onereport->Project->Projectfile->find("all",array("conditions"=>array("Projectfile.project_id" => $onereport["Project"]["id"])) );
						}
					}
					$this->set('onereports', $onereports );
					$this->set("pagina" , false);
				}
				else{*/
					$this->paginate = array('order'=> 'Onereport.fecha desc','conditions'=>$conditions);
					$this->set('onereports', $this->paginate());
					$this->set("pagina" ,true);
				//}
					/*$engineer = $this->Onereport->Engineer->find("list",array("conditions"=>array("Engineer.filial_id<=3")));*/
					$indicator = $this->Onereport->Indicator->find("list");
					$idea = $this->Onereport->Ideasstate->find("list");
					$carta = $this->Onereport->Cartastate->find("list");
					$proyecto = $this->Onereport->Proyectostate->find("list");
					$unity = $this->Onereport->Unity->find('list');
					/*foreach($engineer as $key=>&$e){
						$e = $this->requestAction("/engineers/getName/".$key);
					}


					$engineer[0] = "Seleccione Ingeniero";
					$indicator[0] = "Seleccione actividad";
					$idea[0] = "Seleccione estado de idea";
					$carta[0] = "Seleccione estado de la carta";
					$proyecto[0] = "Seleccione estado del proyecto";
					$unity[0] = 'Seleccione una unidad';
		
		
		
					$this->set("engineer", $engineer);*/
					$this->set("indicator", $indicator);
					$this->set("idea",$idea);
					$this->set("carta",$carta);
					$this->set("proyecto",$proyecto);
					$this->set('unity',$unity);

				//$this->set("onereports",$this->Onereport->find("all",array("conditions"=>array("Onereport.engineer_id"=>$engineer))));
			}
			else{
				$this->set("pagina",true);
				//$this->index();
			}
			

		}
		else{
			$this->set("pagina",true);
			//$this->index();
		}
	}
	
	function buscar($proyectos = null){
	if($proyectos || isset($this->data['Onereport']['proyectoFlag'])){
		$this->set('title_for_layout','Sistema de reportes | Registro de ideas | Buscar proyectos');
		$this->set('proyectos','proyectos');
	}
	else{
		$this->set('title_for_layout','Sistema de reportes | Registro de ideas | Buscar ideas');
	}
	$usuario=$this->Session->read('Auth.User');
	if($this->data){
			parent::loguea($this->data,$this->here);
			$conditions = array();
			if($this->data["Onereport"]["ingeniero"]!= 0){
				$conditions["Onereport.engineer_id"] = $this->data["Onereport"]["ingeniero"];
			}
			if($this->data["Onereport"]["emsefor_id"]!= 0){
				$conditions["Onereport.emsefor_id"] = $this->data["Onereport"]["emsefor_id"];
			}
			if($this->data["Onereport"]["indicator"] != 0){
				$conditions["Onereport.indicator_id"] = $this->data["Onereport"]["indicator"];
			}
			if($this->data["Onereport"]["idea"] != 0){
				$conditions["Onereport.ideasstate_id"]=$this->data["Onereport"]["idea"];
			}
			if($this->data["Onereport"]["carta"] != 0){
				$conditions["Onereport.cartastate_id"]=$this->data["Onereport"]["carta"];
			}
			if($this->data["Onereport"]["proyecto"] != 0){
				$conditions["Onereport.proyectostate_id"]=$this->data["Onereport"]["proyecto"];
			}
			if($this->data['Onereport']['unity'] != 0){
				$conditions["Onereport.unity_id"]=$this->data["Onereport"]["unity"];
			}
			if($proyectos){
				$conditions['Onereport.ideasstate_id'] = 2;
				$conditions['Onereport.proyectostate_id'] = 2;
			
			}
		
		$this->Onereport->recursive = 0;
		if(isset($conditions) && count($conditions)>0){
			$this->set('onereports', $this->Onereport->find("all",array("conditions"=>$conditions) ) );
			$this->set("pagina" , false);
		}
		else{
		if($usuario['group_id'] == 4){
				$user = $this->Engineer->find('all',array('conditions'=>array('user_id'=>$usuario['id'])));
				$filialIngeniero=$user[0]['Filial']['id']-5;
				$filialIngeniero = $this->Engineer->find('list',array('conditions'=>array('filial_id'=>$filialIngeniero)));

				$conditions['Onereport.engineer_id'] = array();
				foreach($filialIngeniero as $key=>$value){
					array_push($conditions['Onereport.engineer_id'],$key);
				}
				
				
			}
			$this->set('onereports', $this->paginate());
			$this->set("pagina" ,true);
		}
		}
		
		$usuario = $this->Session->read("Auth.User");	
		if($usuario['group_id'] == 2){
			$engineer = $this->Onereport->Engineer->find("list",array("conditions"=>array("Engineer.user_id=".$usuario['id'])));		
		
		}
		else if($usuario['group_id'] == 4){
				$user = $this->Engineer->find('all',array('conditions'=>array('user_id'=>$usuario['id'])));
				$filialIngeniero=$user[0]['Filial']['id']-5;
				$filialIngeniero = $this->Engineer->find('list',array('conditions'=>array('filial_id'=>$filialIngeniero)));
				$conditions = array();
				$conditions['Onereport.engineer_id'] = array();
				foreach($filialIngeniero as $key=>$value){
					array_push($conditions['Onereport.engineer_id'],$key);
				}
				$engineer = $this->Onereport->Engineer->find("list",array("conditions"=>array("Engineer.filial_id<=3",'Engineer.id'=>$conditions['Onereport.engineer_id'])));
		}
		else{
		
				$engineer = $this->Onereport->Engineer->find("list",array("conditions"=>array("Engineer.filial_id<=3")));
		}
		if($usuario['group_id'] != 2){
			$engineer[0] = "Seleccione ingeniero";
		}
		
		$indicator = $this->Onereport->Indicator->find("list");
		$idea = $this->Onereport->Ideasstate->find("list");
		$carta = $this->Onereport->Cartastate->find("list");
		$proyecto = $this->Onereport->Proyectostate->find("list");
		$unity = $this->Onereport->Unity->find('list');
		foreach($engineer as $key=>&$e){
			$e = $this->requestAction("/engineers/getName/".$key);
		}
		if(count($engineer)>2){
			$engineer[0] = "Seleccione Ingeniero";
			
		}

		$indicator[0] = "Seleccione indicador";
		$idea[0] = "Seleccione estado de idea";
		$carta[0] = "Seleccione estado de la carta";
		$proyecto[0] = "Seleccione estado del proyecto";
		$unity[0] = 'Seleccione una unidad';
		$this->set("engineer", $engineer);
		$this->set("indicator", $indicator);
		$this->set("idea",$idea);
		$this->set("carta",$carta);
		$this->set("proyecto",$proyecto);
		$this->set('unity',$unity);
		parent::loguea($this->data,$this->here);
	
	}
	
	
	function aprobarIdea($id = null){
		
		if($id){

			$this->Onereport->id = $id;
			$idea = $this->Onereport->read($id,null);
			$this->Onereport->saveField('ideasstate_id',2);
			$this->Onereport->saveField('cartastate_id',2);
			$this->Onereport->saveField('proyectostate_id',1);	
			$this->Session->setFlash("La idea ha sido aprobada");
			$this->loadModel('Onereporthistory');
			$onereporthistory = array();
			$onereporthistory['Onereporthistory']['onereport_id'] = $id;
			$onereporthistory['Onereporthistory']['indicador'] = "Cambio en estado de idea";
			$onereporthistory['Onereporthistory']['eanterior'] = $idea['Onereport']['ideastate_id'];
			$onereporthistory['Onereporthistory']['esiguiente'] = "2";
			if($this->Onereporthistory->save($onereporthistory)){
					$this->Session->setFlash("La idea ha sido aprobada");
			
			}
			$onereporthistory['Onereporthistory']['onereport_id'] = $id;
			$onereporthistory['Onereporthistory']['indicador'] = "Cambio en estado de carta";
			$onereporthistory['Onereporthistory']['eanterior'] = $idea['Onereport']['cartastate_id'];
			$onereporthistory['Onereporthistory']['esiguiente'] = "2";
			pr($onereporthistory);
			exit();
			if($this->Onereporthistory->save($onereporthistory)){
					$this->Session->setFlash("La idea ha sido aprobada");
			
			}
			$this->redirect(array("action"=>"abiertas"));
			
			
		}
		
	}

	function preparacion($id = null){
		
		if($id){

			$this->Onereport->id = $id;
			$this->Onereport->saveField('proyectostate_id',6);			
			$this->Session->setFlash("El proyecto está en preparación");
			$this->redirect(array("action"=>"abiertas"));
			
			
		}
		
	}


	function reprocesoIdea($id = null){
		
		if($id){

			$this->Onereport->id = $id;
			$this->Onereport->saveField('ideasstate_id',4);
			$this->Onereport->saveField('cartastate_id',3);
			$this->Onereport->saveField('proyectostate_id',5);			
			$this->Session->setFlash("La idea ha sido puesta en reproceso");
			$this->redirect(array("action"=>"abiertas"));
			
			
		}
		
	}


	function rechazarIdea($id = null){
		if($id){
			$this->Onereport->id = $id;
			$this->Onereport->saveField("ideasstate_id",3);
			$this->Session->setFlash("La idea ha sido rechazada");
			$this->redirect(array('action' => 'abiertas'));
			parent::loguea($this->data,$this->here);
		}
	}


	
	function estadoideasingeniero(){
		$filials = $this->Filial->find("list",array("conditions"=>array("Filial.id <="=> 3)));
		$engineers = array();
		foreach($filials as $key => $value){
			
			$engineers[$value] = $this->Engineer->find("list",array("conditions"=>array("Engineer.filial_id" =>$key)));
		}
		foreach($engineers as $key => $value){
			foreach($value as $k => $v){
				$c = array();
				for($i=1;$i<=4;$i++){ 
					 array_push($c,$this->Onereport->find("count", array("conditions"=>array("Onereport.engineer_id"=>$k,"Onereport.ideasstate_id"=>$i))) );
				}
				$engineers[$key][$k] = $c;
			}
			
			
		}
		//pr($engineers);
		//$engineers["FILIAL"]["INGENIERO"] => "Ideas pendientes", "Ideas aprobadas", "Ideas rechazadas", "Ideas reproceso";
		$data = array();	
		$i= 0;	
		foreach($engineers as $key => $value){
			foreach ($value as $k => $v){
				$data[$i] = $v;
				$i++;
				
			}
			
		}
		//pr($engineers);
		//pr($data);
		$ing = array();

		$i=0;
		foreach($engineers as $key=>$value){
			$j=0;
			foreach($value as $k=>$v){
				$suma = $data[$i][0]+$data[$i][1]+$data[$i][2]+$data[$i][3];
				array_push($ing,$this->requestAction("/engineers/getName/".$k)." (".$suma.")");
				
			$i++;
			}

		}
		
		//pr($ing);			
		$this->set("data",$data);
		$this->set("ing",$ing);
		$this->layout  = "ajax";
	}
	function estadoideasfilial(){
			$filials = $this->Filial->find("list",array("conditions"=>array("Filial.id <="=> 3)));
		$engineers = array();
		foreach($filials as $key => $value){
			
			$engineers[$value] = $this->Engineer->find("list",array("conditions"=>array("Engineer.filial_id" =>$key)));
		}
		foreach($engineers as $key => $value){
			foreach($value as $k => $v){
				$c = array();
				for($i=1;$i<=4;$i++){ 
					 array_push($c,$this->Onereport->find("count", array("conditions"=>array("Onereport.engineer_id"=>$k,"Onereport.ideasstate_id"=>$i))) );
				}
				$engineers[$key][$k] = $c;
			}
			
			
		}
		$cero = 0;
		$uno = 0;
		$dos = 0;
		$tres = 0;
		$filiales = array();
		$nombres = array();
		foreach($engineers as $key => $value){

			foreach($value as $v){
				//pr($v);
				$cero += $v[0];
				$uno += $v[1];
				$dos += $v[2];
				$tres += $v[3];
		

			}
			//echo "sali";
			$valores = array();
			$suma = $cero+$uno+$dos+$tres;
			array_push($nombres,$key." (".$suma.")");
			array_push($valores,$cero,$uno,$dos,$tres);
			array_push($filiales,$valores);
			$cero = 0;
			$uno = 0;
			$dos = 0;
			$tres = 0;
			

		}

		$this->set("data",$filiales);
		$this->set("nombresFiliales",$nombres);
		$this->layout = "ajax";
	}

	function topEmsefors($filial = null){
		if($filial){

			$ingFilial = $this->Engineer->find('list',array('conditions'=>array('Engineer.filial_id'=>$filial)));
			$i=0;
			$stringEngineers="";
			$ing = array();
			foreach($ingFilial as $k => $value){
				$ing[$i] = $k;
				if($i==0){
					$stringEngineers = "engineer_id = '".$k."'";

				}
				else{
					$stringEngineers .=" or engineer_id = '".$k."'";
				}
							$i++;
			}

			//$emsefors = $this->Onereport->query('SELECT emsefor_id,count(*) as veces FROM `onereports` where '.$stringEngineers.' group by emsefor_id order by count(*) desc limit 20');
			$emsefors = $this->Onereport->query('SELECT emsefor_id,count(*) as veces FROM `onereports` where '.$stringEngineers.' group by emsefor_id order by count(*) desc');
			//pr($emsefors);

			$e1 = array();
			$nombreEmsefors = array();
			
//			for ($i=0;$i<=19;$i++){
			foreach($emsefors as $emsefor){
				if(array_key_exists($i,$emsefors)){
					$e = array();
					echo $this->requestAction("/filials/getName/".$emsefor["onereports"]["emsefor_id"]);
					array_push($nombreEmsefors,$this->requestAction("/emsefors/getName/".$emsefor["onereports"]["emsefor_id"]));
					array_push($e1,$this->Onereport->find('count',array('conditions'=>array('or'=>array('Onereport.engineer_id'=>$ing),'Onereport.emsefor_id'=>$emsefor["onereports"]["emsefor_id"])  )  ) );
					//$e["filial"]= $emsefors[$i]["onereports"]["emsefor_id"];
					/*
					$e[0]= $this->Onereport->find('count',array('conditions'=>array('Onereport.ideasstate_id'=>1,'or'=>array('Onereport.engineer_id'=>$ing),'Onereport.emsefor_id'=>$emsefors[$i]["onereports"]["emsefor_id"])  )  ); //pendiente
	
					$e[1]= $this->Onereport->find('count',array('conditions'=>array('Onereport.ideasstate_id'=>2,'or'=>array('Onereport.engineer_id'=>$ing),
									'Onereport.emsefor_id'=>$emsefors[$i]["onereports"]["emsefor_id"]))); //aprobada
					$e[2]= $this->Onereport->find('count',array('conditions'=>array('Onereport.ideasstate_id'=>3,'or'=>array('Onereport.engineer_id'=>$ing),
									'Onereport.emsefor_id'=>$emsefors[$i]["onereports"]["emsefor_id"]))); //rechazada
					$e[3]= $this->Onereport->find('count',array('conditions'=>array('Onereport.ideasstate_id'=>4,'or'=>array('Onereport.engineer_id'=>$ing),
									'Onereport.emsefor_id'=>$emsefors[$i]["onereports"]["emsefor_id"]))); // reproceso
					//$e["total"] = $emsefors[$i][0]["veces"]; //total*/
					//array_push($e1,$e);
				}
			}
			

			//pr($e1);
			//pr($filial);
			//pr($nombreEmsefors);
			//exit();
			/*$aux = array();
				$aux[0]= array();
				$aux[1]= array();
				$aux[2]= array();
				$aux[3]= array();
			foreach($e1 as $key=>$value){

				array_push($aux[0],$value[0]);
				array_push($aux[1],$value[1]);
				array_push($aux[2],$value[2]);
				array_push($aux[3],$value[3]);
	
			}*/


			foreach($nombreEmsefors as &$n){
				$n =  utf8_decode(utf8_decode($n));
			
			}
			//pr($nombreEmsefors);
			//exit();
			$this->set("data",$e1);
			$this->set("filial",$filial);
			$this->set("emsefors",$nombreEmsefors);
			$this->layout = 'ajax';
		}
		
		

	}

	function recodificar(){
		$data = $this->Onereport->find("all");
		foreach($data as $d){
			$d["Onereport"]["trabajador"] = utf8_encode($d["Onereport"]["trabajador"]);
			$d["Onereport"]["resumen"] = utf8_encode($d["Onereport"]["resumen"]);
			$d["Onereport"]["observacion"] = utf8_encode($d["Onereport"]["observacion"]);
			
			$this->Onereport->save($d);
			pr($d);
		}


		exit();
		}
	function ideasUnidad($filial = null){
		if($filial){
			$this->Onereport->Unity->recursive = -1;
			$unities = $this->Onereport->Unity->find("all",array('conditions'=>array('Unity.id'=>array (1,2,3,5,7,8))));	
			$ideas = array();
			$nombreUnidad = array();
			$engineers = $this->Onereport->Engineer->find("list",array("conditions"=>array("Engineer.filial_id" => $filial)));
			$ing  = array();
			foreach($engineers as $k=>$v){
				array_push($ing,$k);
			}
			
			foreach($unities as $unity){
				$pieces = explode(" ",$unity["Unity"]["nombre"]);
				if($pieces > 1){
					$nombre = "";
					foreach($pieces as $p){
						$nombre .= $p."\n";
					}
					array_push($nombreUnidad,$nombre);									
				}
				else{
					array_push($nombreUnidad,$unity["Unity"]["nombre"]);
				}
				array_push($ideas,$this->Onereport->find("count",array("conditions" => array("Onereport.unity_id"=>$unity["Unity"]["id"],"Onereport.engineer_id"=> $ing))));
			}
			
			//pr($nombreUnidad);
			//pr($ideas);


			//die();
			$this->set("nombreUnidad",$nombreUnidad);
			$this->set("ideas",$ideas);	
			$this->set("filial",$this->requestAction("/filials/getName/".$filial));				
			$this->layout = 'ajax';

		}


	}

	function proyectosEmsefor($filial = null){


		if($filial){
			
			$engineers = $this->Onereport->Engineer->find("list",array("conditions"=>array("Engineer.filial_id" => $filial)));
			$ing  = array();
			$stringIngenieros = "";
			$i =0;
			foreach($engineers as $k=>$v){
				if($i==0){
					$stringIngenieros .="engineer_id=".$k;
					$i++;
				}
				else{
						$stringIngenieros .=" or engineer_id=".$k;
				}
			}
			$sql = "select emsefor_id, count(*) as veces from onereports where (proyectostate_id = 2 or proyectostate_id = 3) and (".$stringIngenieros.")  group by emsefor_id order by count(*) desc LIMIT 0, 30 ";
					
			$emsefores = $this->Onereport->query($sql);

			$data = array();
			$emsefor = array();
			foreach($emsefores as $e){
				array_push($data, $e[0]["veces"]);
				array_push($emsefor,$this->requestAction("/emsefors/getName/".$e["onereports"]["emsefor_id"]));

			}
			
			$this->set("data",$data);
			$this->set("nombreEmsefor",$emsefor);			
			$this->set("filial",$filial);
			$this->layout = 'ajax';

		}
}
				

	function proyectosEvaluacionUnidadEmsefor($filial = null){
		if($filial){
			$this->Onereport->Unity->recursive = -1;
			$unities = $this->Onereport->Unity->find("all",array('conditions'=>array('Unity.id'=>array(1,2,3,5,7,8))));
			$ideas = array();
			$nombreUnidad = array();
			$engineers = $this->Onereport->Engineer->find("list",array("conditions"=>array("Engineer.filial_id" => $filial)));
			$ing  = array();
			foreach($engineers as $k=>$v){
				array_push($ing,$k);
			}
			
			foreach($unities as $unity){
				$pieces = explode(" ",$unity["Unity"]["nombre"]);
				if($pieces > 1){
					$nombre = "";
					foreach($pieces as $p){
						$nombre .= $p."\n";
					}
					array_push($nombreUnidad,$nombre);									
				}
				else{
					array_push($nombreUnidad,$unity["Unity"]["nombre"]);
				}
				array_push($ideas,$this->Onereport->find("count",array("conditions" => array("Onereport.unity_id"=>$unity["Unity"]["id"],"Onereport.engineer_id"=> $ing,"Onereport.proyectostate_id" => array(2,3,4)))));
			}
			
			//pr($nombreUnidad);
			//pr($ideas);


			//die();
			$this->set("nombreUnidad",$nombreUnidad);
			$this->set("ideas",$ideas);	
			$this->set("filial",$this->requestAction("/filials/getName/".$filial));				
			$this->layout = 'ajax';

		}

	}
		function asignarIdea(){
			$this->set('title_for_layout','Sistema de reportes | Asignar proyecto');
		/*	$reporte = $this->Onereport->find("all",array("conditions"=>array("Onereport.proyectostate_id" => array(2)),'order'=>'Onereport.proyectofecha desc '));
			foreach($reporte as &$r){
				if(!empty($r['Project']['id'])){
					$r['Projectfile'] = $this->Onereport->Project->Projectfile->find("all",array('conditions'=>array('Projectfile.project_id'=>$r['Project']['id']),'order'=>'Projectfile.created desc') );
				}

			}
*/
			$this->set("onereports",$this->paginate('Onereport',array("Onereport.proyectostate_id" => array(2))));
			parent::loguea($this->data,$this->here);
			
		

	}
		function asignar($id = null){
			if($id){
			 	
				$this->Onereport->Engineer->recursive=0;
				$engineers = $this->Onereport->Engineer->find("all",array("conditions"=>array("User.group_id"=>array(6,3))));
				$ing = array();
				foreach($engineers as $engineer){
					$ing[$engineer["Engineer"]["id"]] = $engineer["Engineer"]["nombre"]." ".$engineer["Engineer"]["apellido"];
				}
			$this->set("engineers",$ing);
			$this->set("onereport",$this->Onereport->read(null,$id) );
			$this->set("onereport_id",$id);	
			}	
			if(!empty($this->data)){
				parent::loguea($this->data,$this->here);
				$reporte = $this->Onereport->read(null,$this->data["Onereport"]["onereport_id"]);
				$reporte["Onereport"]["encargado_id"] = $this->data["Onereport"]["engineers"];
				if($this->Onereport->save($reporte)){
					$this->Session->setFlash("El reporte ha sido asignado satisfactoriamente");
					$this->redirect(array("action"=>"asignarIdea"));
		
				}

				
				

			}



		}
		
		function misIdeas(){ //Asignaciones de ideas a los evaluadores

			$usuario = $this->Session->read('Auth.User');
			$onereports = $this->Onereport->find("all",array("conditions"=>array("Onereport.encargado_id"=>$this->requestAction("/engineers/getId/".$usuario["id"]))));
			foreach($onereports as &$onereport){

				if(!empty($onereport['Project']['id'])){
					$onereport['Projectfile'] = $this->Projectfile->find('all',array('conditions'=>array('Projectfile.project_id'=>$onereport['Project']['id'])));
				}

			}

			$this->set("onereports",$onereports);
			parent::loguea($this->data,$this->here);

	
		}
		
    function completaIdeas($id=null,$nuevoestado){
       if($id){
         	$idea = $this->Onereport->read(null,$id);
          $this->Onereport->id = $id;
          $this->Onereport->saveField('businessstate_id',$nuevoestado);
					$this->_onereportHistory($id,"Negocio",$idea['Onereport']['businesstate_id'],5);
          $this->redirect($this->referer());
					parent::loguea($this->data,$this->here);
    }
      
  
  }
  function estadoCarta($id=null,$nuevoestado){
   if($id){
     	$idea = $this->Onereport->read(null,$id);
      $this->Onereport->id = $id;
      $this->Onereport->saveField('cartastate_id',$nuevoestado);
 			$this->_onereportHistory($id,"Carta",$idea['Onereport']['cartastate_id'],$nuevoestado);
      $this->redirect($this->referer());
      parent::loguea($this->data,$this->here);

    }

   }
  function estadoIdea($id = null,$nuevoestado){
    if($id){
    	$idea = $this->Onereport->read(null,$id);
    	pr($idea);
      $this->Onereport->id = $id;
      $this->Onereport->saveField('ideasstate_id',$nuevoestado);
 			$this->_onereportHistory($id,"Idea",$idea['Onereport']['ideasstate_id'],$nuevoestado);
			if($nuevoestado == 1){
      	$this->Onereport->saveField('cartastate_id',3);
 	 			if($idea['Onereport']['cartastate_id'] != 3) $this->_onereportHistory($id,"Carta",$idea['Onereport']['cartastate_id'],3);
      	$this->Onereport->saveField('proyectostate_id',5);
 	 			if($idea['Onereport']['proyectostate_id'] != 5) $this->_onereportHistory($id,"Proyecto",$idea['Onereport']['proyectostate_id'],5);
      	parent::loguea($this->data,$this->here);
      
      }
      else if($nuevoestado == 2){
      	$this->Onereport->saveField('cartastate_id',2);
 	 			if($idea['Onereport']['cartastate_id'] != 2) $this->_onereportHistory($id,"Carta",$idea['Onereport']['cartastate_id'],2);
      	$this->Onereport->saveField('proyectostate_id',1);
 	 			if($idea['Onereport']['proyectostate_id'] != 1) $this->_onereportHistory($id,"Proyecto",$idea['Onereport']['proyectostate_id'],1);
      	
      }
      else if($nuevoestado == 3 || $nuevoestado == 4){
      	$this->Onereport->saveField('cartastate_id',2);
 	 			if($idea['Onereport']['cartastate_id'] != 3) $this->_onereportHistory($id,"Carta",$idea['Onereport']['cartastate_id'],3);
      	$this->Onereport->saveField('proyectostate_id',5);
 	 			if($idea['Onereport']['proyectostate_id'] != 5)$this->_onereportHistory($id,"Proyecto",$idea['Onereport']['proyectostate_id'],5);
      
      }

      $this->redirect($this->referer());

    }
  
  }
  function estadoProyecto($id =null,$nuevoestado){
  	if($id){
    	$idea = $this->Onereport->read(null,$id);
  		$this->Onereport->id = $id;
  		$this->Onereport->saveField('proyectostate_id',$nuevoestado);
			$this->_onereportHistory($id,"Proyecto",$idea['Onereport']['proyectostate_id'],$nuevoestado);
  		if($nuevoestado == 3){
  			$fecha = array();
  			$fecha['year'] = date('Y');
  			$fecha['month'] = date('m');	
  			$fecha['day'] = date('d');
  			$this->Onereport->saveField('proyectofechafin',$fecha);
  		}
      
      $this->redirect($this->referer());
      parent::loguea($this->data,$this->here);
  	
  	}
  
  	
  }
   function _onereportHistory($id,$indicador,$eanterior,$esgiuiente){
  	$this->loadModel('Onereporthistory');
		$this->Onereporthistory->create();
  	$onereporthistory['Onereporthistory']['onereport_id'] = $id;
		$onereporthistory['Onereporthistory']['indicador'] = $indicador;
		$onereporthistory['Onereporthistory']['eanterior'] = $eanterior;
		$onereporthistory['Onereporthistory']['esiguiente'] = $esgiuiente;
		if($this->Onereporthistory->save($onereporthistory,false)){
			echo $indicador." ";
			echo $this->Onereporthistory->id."\n";
		
		}
		else{
			echo $id." ".$indicador." ".$eanterior." ".$esiguiente."\n";
			exit();
		
		}
  }
}
?>
