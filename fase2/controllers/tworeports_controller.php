<?php
class TworeportsController extends AppController {

	var $name = 'Tworeports';
	var $uses = array('Tworeport','Filial',"Engineer");
	var $paginate = array('order'=>array('semana'=>'desc'));
	function index() {
		$usuario = $this->Session->read('Auth.User');
		$this->set('title_for_layout','Sistema de reportes | Registro de planificación');
		if($this->data){
			$conditions = array();
			if($this->data["Tworeport"]["semana"] != 0){
				$conditions["Tworeport.semana"]= $this->data["Tworeport"]["semana"];
			}
			if($this->data["Tworeport"]["emsefor_id"]!= 0){
				$conditions["Tworeport.emsefor_id"] = $this->data["Tworeport"]["emsefor_id"];
			}
			if($this->data["Tworeport"]["ingeniero"]!= 0){
				$conditions["Tworeport.engineer_id"] = $this->data["Tworeport"]["ingeniero"];
			}
			if($this->data["Tworeport"]["actividad"] != 0){
				$conditions["Tworeport.activity_id"] = $this->data["Tworeport"]["actividad"];
			}
			if($this->data["Tworeport"]["estado"] != 0){
				$conditions["Tworeport.state_id"]=$this->data["Tworeport"]["estado"];
			}
			if($this->data["Tworeport"]["unidad"] != 0){
				$conditions["Tworeport.unity_id"]=$this->data["Tworeport"]["unidad"];
			}
		}

		$tworeports = $this->Tworeport->query("SELECT DISTINCT (`Tworeport`.`semana`) as semana FROM `tworeports` AS `Tworeport` WHERE 1 = 1 ORDER BY `Tworeport`.`semana` DESC ");
		$semana = array();
		foreach($tworeports as $tworeport){
			$semana[$tworeport["Tworeport"]["semana"]] = $tworeport["Tworeport"]["semana"];
		}
		$this->Tworeport->recursive = 0;
		if(isset($conditions) && count($conditions)>0){
			$this->set('tworeports', $this->Tworeport->find("all",array("conditions"=>$conditions) ) );
			$this->set("pagina" , false);
		}
		else{
			$conditions = array();
			if($usuario['group_id'] == 4){
				$user = $this->Engineer->find('all',array('conditions'=>array('user_id'=>$usuario['id'])));
				$filialIngeniero=$user[0]['Filial']['id']-5;
				$filialIngeniero = $this->Engineer->find('list',array('conditions'=>array('filial_id'=>$filialIngeniero)));
				$conditions['Tworeport.engineer_id'] = array();
				foreach($filialIngeniero as $key=>$value){
					array_push($conditions['Tworeport.engineer_id'],$key);
				}
			}
			$this->set('tworeports', $this->paginate('Tworeport',$conditions));
			$this->set("pagina" ,true);
		}
		$semana[0] = "Seleccione semana";
		$this->set("semana",$semana);
	
		if($usuario['group_id']==4){
			$usuario = $this->Engineer->find('all',array('conditions'=>array('user_id'=>$usuario['id'])));
				$filialIngeniero=$usuario[0]['Filial']['id']-5;
				$filialIngeniero = $this->Engineer->find('list',array('conditions'=>array('filial_id'=>$filialIngeniero)));
				$conditions = array();
				$conditions['Tworeport.engineer_id'] = array();
				foreach($filialIngeniero as $key=>$value){
					array_push($conditions['Tworeport.engineer_id'],$key);
				}
			$engineer = $this->Tworeport->Engineer->find("list",array('conditions'=>array('Engineer.id'=>$conditions['Tworeport.engineer_id'])));
			
		}
		else{
			$engineer = $this->Tworeport->Engineer->find("list",array('conditions'=>array('Engineer.filial_id<3')));
		}
		foreach($engineer as $key=>&$e){
			$e = $this->requestAction("/engineers/getName/".$key);
		}
		
		
		$activity = $this->Tworeport->Activity->find("list");
		$estado = $this->Tworeport->State->find("list");	
		$unity = $this->Tworeport->Unity->find("list");	
		$engineer[0] = "Seleccione Ingeniero";
		$activity[0] = "Seleccione actividad";
		$estado[0] = "Seleccion estado";
		$unity[0] = 'Seleccione una unidad';
		
		$this->set("engineer", $engineer);
		$this->set("activity", $activity);
		$this->set("estado", $estado);
		$this->set("unity", $unity);
		parent::loguea($this->data,$this->here);
	}

	function view($id = null, $ing = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid tworeport', true));
			$this->redirect(array('action' => 'ver'));
		}
		$this->set('tworeport', $this->Tworeport->read(null, $id));
		$this->set('title_for_layout','Sistema de reportes | Registro de planificación | Viendo planificación '.$id);
		parent::loguea($this->data,$this->here);
	}

	function add($id=null) {
		$this->set('title_for_layout','Sistema de reportes | Registro de planificación | Agregar nueva planificación');
		if (!empty($this->data)) {
			$this->Tworeport->create();
			if($this->data["Tworeport"]["emsefor_id"] == ""){
				$this->Session->setFlash(__('La planificación no ha sido guardada, recuerde completar el campo EMSEFOR', true));
			}
			

			$epoch = strtotime("20 January 2011");

			$week = 86400*7; // Day in seconds 
			$sTime = $epoch;
			//$sTime = strtotime($start); // Start as time 
			$eTime = strtotime("now"); // End as time
			$numDays = ($eTime - $sTime) / $week;
			$weeks = explode(".",$numDays);
			$semana= $weeks[0]+13;
			$this->data["Tworeport"]["semana"] = $semana;

			if ($this->Tworeport->save($this->data)) {
				$this->Session->setFlash(__('La planificación ha sido guardada con éxito.', true));
				$this->redirect(array('action' => 'ver'));
			} else {
				$this->Session->setFlash(__('La planificación no ha sido guardada, revise los datos.', true));
			}
		}
		$user = $this->Session->read("Auth.User");
		if($user["group_id"]!=1){
			$this->Tworeport->Engineer->recursive = 0;
			//$engineers = $this->Tworeport->Engineer->find('list',array('conditions'=>array("Engineer.user_id" => $user["id"])));
			$ing = $this->Tworeport->Engineer->find('all',array('conditions'=>array("Engineer.user_id" => $user["id"])));
			$filial= $ing[0]["Engineer"]["filial_id"];
			$emsefors = $this->Tworeport->Emsefor->find("list",array("conditions"=>array("Emsefor.filial_id"=>$filial,"Emsefor.id >"=>1000)));

		}
		else{	
			$ing = $this->Tworeport->Engineer->find('all');
			$emsefors = $this->Tworeport->Emsefor->find("list");
		}
		$engineers = array();		
		foreach($ing as $i){
			$engineers[$i["Engineer"]["id"]] = $i["Engineer"]["nombre"]." ".$i["Engineer"]["apellido"];
		}

		if(!$id){
				$padre = array(0,0);
						
			}
			else{
				$reporte = $this->Tworeport->read(null,$id);
				$padre = array($id, $reporte["Tworeport"]["order"]+1);
							
			}
		$activities = $this->Tworeport->Activity->find('list');
		
		$e = array();
		foreach($emsefors as $key=>$value){
			$e[$key] = utf8_encode($value);
		}

		$emsefors = $e;

		$places = $this->Tworeport->Place->find("list");
		$unities = $this->Tworeport->Unity->find('list');
		$states = $this->Tworeport->State->find('list');
		$this->set(compact('engineers', 'activities', 'emsefors', 'unities', 'states','padre','places'));
	}

	function ver($id = null){
		$user = $this->Session->read("Auth.User");
		
		if($user["group_id"] != 1){
			/*
			1	Planificada
			2	Realizada
			3	No realizada
			4	Replanificada
			*/
			$conditions = array();
			$engineer = $this->requestAction("/engineers/getId/".$user["id"]);
			$conditions["Tworeport.engineer_id"] = $engineer;
			if($this->data){
				$conditions = array();
				if($this->data["Tworeport"]["semana"] != 0){
					$conditions["Tworeport.semana"]= $this->data["Tworeport"]["semana"];
				}
				if($this->data["Tworeport"]["actividad"] != 0){
					$conditions["Tworeport.activity_id"] = $this->data["Tworeport"]["actividad"];
				}
				if($this->data["Tworeport"]["emsefor_id"]!= 0){
					$conditions["Tworeport.emsefor_id"]= $this->data["Tworeport"]["emsefor_id"];
					}
				if($this->data["Tworeport"]["unidad"]!= 0){
					$conditions["Tworeport.unity_id"]= $this->data["Tworeport"]["unidad"];
					}	
					parent::loguea($this->data,$this->here);
		}
		if($id != null && ( $id == 1 || $id == 2 || $id == 3 || $id == 4 )){
			$conditions["Tworeport.state_id"]=$id;
		switch($id){
						case 1:
							$this->set('title_for_layout','Sistema de reportes | Registro de planificación | Planificadas');
							break;
					
						case 2:
							$this->set('title_for_layout','Sistema de reportes | Registro de ideas | Realizadas');
							break;
						case 3:
							$this->set('title_for_layout','Sistema de reportes | Registro de ideas | No realizadas');
							break;
						case 4:
							$this->set('title_for_layout','Sistema de reportes | Registro de ideas | Replanificadas');
							break;
					}
				}
				else{
						$this->set('title_for_layout','Sistema de reportes | Registro de planificación | Todas');
				}
		$tworeports = $this->Tworeport->query("SELECT DISTINCT (`Tworeport`.`semana`) as semana FROM `tworeports` AS `Tworeport` WHERE 1 = 1 ORDER BY `Tworeport`.`semana` DESC ");
		$semana = array();
		foreach($tworeports as $tworeport){
			$semana[$tworeport["Tworeport"]["semana"]] = $tworeport["Tworeport"]["semana"];
		}
		
		$this->Tworeport->recursive = 0;
			$this->set('tworeports', $this->Tworeport->find("all",array("conditions"=>$conditions,'order' => 'Tworeport.fecha desc') ) );
			$engineers = $this->Tworeport->Engineer->find("all",array("conditions" => array("Engineer.user_id"=>$user['id'])));
			$conditions['Tworeport.engineer_id']=$engineers[0]['Engineer']['id'];	
			$this->set('tworeports', $this->paginate('Tworeport',$conditions));	
			//$this->set('tworeports', $this->paginate(array('Tworeport.engineer_id'=>$engineers[0]['Engineer']['id'])));
			$this->set("pagina" ,true);
		$semana[0] = "Seleccione semana";
		$this->set("semana",$semana);
		$engineer = $this->Tworeport->Engineer->find("list");
		$activity = $this->Tworeport->Activity->find("list");
		$estado = $this->Tworeport->State->find("list");	
		$unity = $this->Tworeport->Unity->find("list");	
		$engineer[0] = "Seleccione Ingeniero";
		$activity[0] = "Seleccione actividad";
		$unity[0] = 'Seleccione una unidad';
		
		$this->set("engineer", $engineer);
		$this->set("activity", $activity);
		$this->set("unity", $unity);

			
			
		}
		else{
			$this->index();
		}
	}

	function tabla1(){
		$this->layout = 'ajax';
	}
	function buscar(){
		$user = $this->Session->read("Auth.User");
		
		if($user["group_id"] != 1){
			/*
			1	Planificada
			2	Realizada
			3	No realizada
			4	Replanificada
			*/
			$conditions = array();
			$engineer = $this->requestAction("/engineers/getId/".$user["id"]);
			$conditions["Tworeport.engineer_id"] = $engineer;
			if($this->data){
				$conditions = array();
				if($this->data["Tworeport"]["semana"] != 0){
					$conditions["Tworeport.semana"]= $this->data["Tworeport"]["semana"];
				}
				if($this->data["Tworeport"]["actividad"] != 0){
					$conditions["Tworeport.activity_id"] = $this->data["Tworeport"]["actividad"];
				}
				if($this->data["Tworeport"]["emsefor_id"]!= 0){
					$conditions["Tworeport.emsefor_id"]= $this->data["Tworeport"]["emsefor_id"];
					}
				if($this->data["Tworeport"]["unidad"]!= 0){
					$conditions["Tworeport.unity_id"]= $this->data["Tworeport"]["unidad"];
					}	
					parent::loguea($this->data,$this->here);
		
		$tworeports = $this->Tworeport->query("SELECT DISTINCT (`Tworeport`.`semana`) as semana FROM `tworeports` AS `Tworeport` WHERE 1 = 1 ORDER BY `Tworeport`.`semana` DESC ");
		$semana = array();
		foreach($tworeports as $tworeport){
			$semana[$tworeport["Tworeport"]["semana"]] = $tworeport["Tworeport"]["semana"];
		}
		
			$this->Tworeport->recursive = 0;
			$this->set('tworeports', $this->Tworeport->find("all",array("conditions"=>$conditions,'order' => 'Tworeport.fecha desc') ) );
			$engineers = $this->Tworeport->Engineer->find("all",array("conditions" => array("Engineer.user_id"=>$user['id'])));
			$conditions['Tworeport.engineer_id']=$engineers[0]['Engineer']['id'];	
			$this->set('tworeports', $this->paginate('Tworeport',$conditions));	
			//$this->set('tworeports', $this->paginate(array('Tworeport.engineer_id'=>$engineers[0]['Engineer']['id'])));
			$this->set("pagina" ,true);
		}
		$semana[0] = "Seleccione semana";
		$this->set("semana",$semana);
		$engineer = $this->Tworeport->Engineer->find("list");
		$activity = $this->Tworeport->Activity->find("list");
		$estado = $this->Tworeport->State->find("list");
		$unity = $this->Tworeport->Unity->find("list");	
		$engineer[0] = "Seleccione Ingeniero";
		$activity[0] = "Seleccione actividad";
		$unity[0] = 'Seleccione una unidad';
		
		$this->set("engineer", $engineer);
		$this->set("activity", $activity);
		$this->set("unity", $unity);
		$this->set("estado", $estado);
			
			
		}
		else{
			$this->index();
		}
	
	
	
	
	}
	function reporte(){
		
		$this->set("download",false);
		$engineers = array("0"=> "Seleccione ingeniero");
		$ing = 	$this->Tworeport->Engineer->find("list");	
		foreach($ing as $i){
			array_push($engineers,$i);
		}
		
		$tworeports = $this->Tworeport->query("SELECT DISTINCT (`Tworeport`.`semana`) as semana FROM `tworeports` AS `Tworeport` WHERE 1 = 1 ORDER BY `Tworeport`.`semana` DESC ");
		$reporte = array();
		foreach($tworeports as $tworeport){
			array_push($reporte,$tworeport["Tworeport"]["semana"]);
		}
		
		$tworeports = array("0"=>"Seleccione semana");
		foreach($reporte as $r){
			array_push($tworeports,$r);
		}
		
		$filials = array("0"=>"Seleccione Filial");
	
		$fil = $this->Filial->find("list");
		foreach($fil as $f){
			array_push($filials,$f);
		}
		
		$this->set(compact('engineers','tworeports','filials'));
		if($this->data){
			
			$conditions = array();
			if($this->data["Tworeport"]["tworeports"] != 0){
				$this->data["Tworeport"]["tworeports"]= $tworeports[$this->data["Tworeport"]["tworeports"]];
				array_push($conditions,array("Tworeport.semana" => $this->data["Tworeport"]["tworeports"]));

			}
			if($this->data["Tworeport"]["engineers"]!= 0){
				array_push($conditions,array("Tworeport.engineer_id" => $this->data["Tworeport"]["engineers"]));
			
				
			}

			if($this->data["Tworeport"]["filials"] != 0){
				$ing = $this->Tworeport->Engineer->find("list",array("conditions"=>array("Engineer.filial_id"=>$this->data["Tworeport"]["filials"])));


				$j=0;
				$c = array();				
				foreach($ing as $i=>$va){
					array_push($c,array("Tworeport.engineer_id" => $i));
					
					
				}
				$o = array("OR"=>$c);
				
				array_push($conditions,$o);
				
				
			}
			
			
			$this->set("download", true);
			$this->Tworeport->recursive = 1;
			$this->Tworeport->order = "Tworeport.fecha DESC";
			$this->set('tworeports', $this->Tworeport->find("all",array("conditions" => $conditions)));
			$this->Tworeport->order = null;
			$this->set("filials",$this->Filial->find("list"));
			$this->layout = "reporte";
		
		}

		
	
	
	}

	function setStats($idUsuario = null,$ing = null){
		//Planificaciones abiertas, cerradas, no planificadas
		if($this->Session->read("Auth.User")){
			if(!$ing){
				$usuario["id"]=$idUsuario;
				
			}
			if($ing!=null){
				$usuario["id"]=$ing;

			}
			$pAbiertas = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=>$usuario["id"],"Tworeport.state_id"=>1)));

			$pRealizadas = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=>$usuario["id"],"Tworeport.state_id"=>2)));

			$pNoRealizadas = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=>$usuario["id"],"Tworeport.state_id"=>3)));

			$pReplanificadas = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=>$usuario["id"],"Tworeport.state_id"=>4)));

			$planificaciones = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.engineer_id"=>$usuario["id"])));

/////
			$tAbiertas = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.state_id"=>1)));

			$tRealizadas = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.state_id"=>2)));

			$tNoRealizadas = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.state_id"=>3)));

			$tReplanificadas = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.state_id"=>4)));

			$tplanificaciones = $this->Tworeport->find("count");
		$reunionPlanificacion = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.activity_id"=>6)));
		$reunionEM = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.activity_id"=>10)));
		$reunionGE = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.activity_id"=>9)));
		$reunionTaller = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.activity_id"=>11)));


			return array("abiertas"=>$pAbiertas,"realizadas" => $pRealizadas,"nrealizadas"=>$pNoRealizadas,"replanificadas"=> $pReplanificadas,"planificaciones"=>$planificaciones,"tabiertas"=>$tAbiertas,"trealizadas"=>$tRealizadas,"tnorealizadas"=>$tNoRealizadas,"treplanificadas"=>$tReplanificadas,"tplanificaciones"=>$tplanificaciones,"reunionPlanificacion"=>$reunionPlanificacion,"reunionEM"=>$reunionEM,"reunionGE"=>$reunionGE,"reunionTaller"=>$reunionTaller);
			
			
		}

	}

	function edit ($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid tworeport', true));
			$this->redirect(array('action' => 'ver'));
		}
		if (!empty($this->data)) {
			$epoch = strtotime("20 January 2011");
			$dataDate = strtotime($this->data["Tworeport"]["fecha"]["year"]."-". $this->data["Tworeport"]["fecha"]["month"]."-". $this->data["Tworeport"]["fecha"]["day"]);
			$week = 86400*7; // Day in seconds 
			$sTime = $epoch;
			if($dataDate>$epoch){			
					//$eTime = strtotime("now"); // End as time
					$numDays = ($dataDate - $epoch) / $week;
					$weeks = explode(".",$numDays);
					$semana= $weeks[0]+13;
					$this->data["Tworeport"]["semana"] = $semana;			
			}
			else{
					
				
			}			


			
			if ($this->Tworeport->save($this->data)) {
				parent::loguea($this->data,$this->here);
				$this->Session->setFlash(__('La reunión '.$this->data["Tworeport"]["id"]." ha sido editada.", true));
				$usuario = $this->Session->read('Auth.User');
				if($usuario['group_id'] == 2){
						$this->redirect(array('action'=>'ver'));
				}
				else{
					$this->redirect(array('action' => 'index'));
				}
			} else {
				$this->Session->setFlash(__('The tworeport could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Tworeport->read(null, $id);
			$this->set("emsefors_id",$this->data["Tworeport"]["emsefor_id"]);
		}
		
		$user = $this->Session->read("Auth.User");
		if($user["group_id"]!=1){
			$this->Tworeport->Engineer->recursive = 0;
			//$engineers = $this->Tworeport->Engineer->find('list',array('conditions'=>array("Engineer.user_id" => $user["id"])));
			$ing = $this->Tworeport->Engineer->find('all',array('conditions'=>array("Engineer.user_id" => $user["id"])));
			$filial= $ing[0]["Engineer"]["filial_id"];
			$emsefors = $this->Tworeport->Emsefor->find("list",array("conditions"=>array("Emsefor.filial_id"=>$filial,"Emsefor.id >"=>1000)));

		}
		else{	
			$ing = $this->Tworeport->Engineer->find('all');
			$emsefors = $this->Tworeport->Emsefor->find("list",array("conditions"=>array("Emsefor.id >1000")));
		}


		$e = array();
		foreach($emsefors as $key=>$value){
			
			$e[$key] = utf8_encode($value);
		}

		$emsefors = $e;

		$engineers = $this->Tworeport->Engineer->find('list');
		$activities = $this->Tworeport->Activity->find('list');
		//$emsefors = $this->Tworeport->Emsefor->find('list',array("conditions"=>array("Emsefor.filial_id"=>1)));
		$unities = $this->Tworeport->Unity->find('list');
		$states = $this->Tworeport->State->find('list');
		foreach($engineers as $e){
			$e = utf8_encode($e);
		}
		$this->set(compact('engineers', 'activities', 'emsefors', 'unities', 'states',"id"));
	}

	function recodificar(){
		$data = $this->Tworeport->find("all");
		foreach($data as $d){
			$d["Tworeport"]["contacto"] = utf8_decode($d["Tworeport"]["contacto"]);
			$d["Tworeport"]["tema"] = utf8_decode($d["Tworeport"]["tema"]);
			$d["Tworeport"]["lugar"] = utf8_decode($d["Tworeport"]["tema"]);
			$this->Tworeport->save($d);
		}


		exit();
		}
		
		function realizada($id = null){
		if (!$id) {
			$this->Session->setFlash(__('Invalid tworeport', true));
			$this->redirect(array('action' => 'ver'));
		}
		else{
			$planificacion = $this->Tworeport->read(null,$id);
			$planificacion["Tworeport"]["state_id"] = 2;
			$this->Tworeport->save($planificacion);
			$this->Session->setFlash("La planificación ha sido marcada como realizada con éxito.");				
			$this->redirect(array("controller"=>"tworeports","action"=>"ver"));
			
		}
		
		}



	function replanificar($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid tworeport', true));
			$this->redirect(array('action' => 'ver'));
		}
		if (!empty($this->data)) {
			$epoch = strtotime("20 January 2011");

			$week = 86400*7; // Day in seconds 
			$sTime = $epoch;
			//$sTime = strtotime($start); // Start as time 
//			$eTime = strtotime("now"); // End as time

			$fecha = $this->data["Tworeport"]["fecha"]["year"]."/".$this->data["Tworeport"]["fecha"]["month"]."/".$this->data["Tworeport"]["fecha"]["day"];	
			$eTime = strtotime($fecha);			
			$numDays = ($eTime - $sTime) / $week;
			$weeks = explode(".",$numDays);
			$semana= $weeks[0]+13;
			$this->data["Tworeport"]["semana"] = $semana;
			$estado = $this->data["Tworeport"]["state_id"];
			$this->data["Tworeport"]["state_id"] = 1;



			if ($this->Tworeport->save($this->data)) {
				
				if($estado != 3){

				$datos = $this->Tworeport->read(null,$this->data["Tworeport"]["parent"]);

				$datos["Tworeport"]["state_id"] = 4;

				$this->Tworeport->save($datos);
				}
				parent::loguea($datos,$this->here);
				$this->Session->setFlash(__('La reunión '.$this->data["Tworeport"]["parent"]." ha sido replanificada.", true));
				$this->redirect(array('action' => 'ver'));
			} else {
				$this->Session->setFlash(__('The tworeport could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Tworeport->read(null, $id);
			$this->data["Tworeport"]["parent"] = $this->data["Tworeport"]["id"];
			$this->data["Tworeport"]["order"] = $this->data["Tworeport"]["order"]+1;
		}
		$user = $this->Session->read("Auth.User");

		$engineers = $this->Tworeport->Engineer->find('list');
		$activities = $this->Tworeport->Activity->find('list');
			$ing = $this->Tworeport->Engineer->find('all',array('conditions'=>array("Engineer.user_id" => $user["id"])));
			$filial= $ing[0]["Engineer"]["filial_id"];
		$emsefors = $this->Tworeport->Emsefor->find('list',array("conditions"=>array("Emsefor.id >"=>1000,"Emsefor.filial_id" => $filial )));
			$emsefor = array();
			foreach($emsefors as $key =>$value){
				$emsefor[$key] = utf8_encode($value);
			}
		$emsefors = $emsefor;					
		$unities = $this->Tworeport->Unity->find('list');
		$states = $this->Tworeport->State->find('list');
		$this->set(compact('engineers', 'activities', 'emsefors', 'unities', 'states',"id"));
	}



	function norealizada($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid tworeport', true));
			$this->redirect(array('action' => 'ver'));
		}
		else{
			$planificacion = $this->Tworeport->read(null,$id);
			$planificacion["Tworeport"]["state_id"] = 3;
			$this->Tworeport->save($planificacion);
			$this->Session->setFlash("La planificación ha sido marcada como no realizada con éxito.");				
			$this->redirect(array("controller"=>"tworeports","action"=>"ver"));
			
		}
		
		
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for tworeport', true));
			$this->redirect(array('action'=>'ver'));
		}
		if ($this->Tworeport->delete($id)) {
			parent::loguea($this->data,$this->here);
			$this->Session->setFlash(__('Planificación eliminada', true));
			$this->redirect($this->referer());
		}
		$this->Session->setFlash(__('Tworeport was not deleted', true));
		
		$usuario = $this->Session->read('Auth.User');
				if($usuario['group_id'] == 2){
						$this->redirect(array('action'=>'ver'));
				}
				else{
					$this->redirect(array('action' => 'index'));
				}
	}

	function reunionesporingeniero(){
		$filials = $this->Filial->find("list",array("conditions"=>array("Filial.id <="=> 3)));
		$engineers = array();
		foreach($filials as $key => $value){
			
			$engineers[$value] = $this->Engineer->find("list",array("conditions"=>array("Engineer.filial_id" =>$key)));
		}

		$estados = array(6,11,9,10); 
		//planificacion, taller, grupo evaluador, GRUPO MEJORA
		//Filiales: 0->FCEL, 1->BASA, 2->FVAL
		
		$ing = array();
		$j =0;
		foreach($engineers as $key => $value){
			foreach ($value as $k=>$v){
				$i = array();
				foreach($estados as $e){
					array_push($i,$this->Tworeport->find("count",array("conditions"=>array("Tworeport.activity_id"=>$e,"Tworeport.engineer_id"=>$k,"Tworeport.state_id"=>2))));
					
			
				}
				$ing[$k] = $i;

				
			}
				$j++;
		}
		//pr($ing);
		$this->set("data",$ing);
		$nombres = array();
		foreach($engineers as $key => $value){
			foreach ($value as $k=>$v){
				$suma = $ing[$k][0]+$ing[$k][1]+$ing[$k][2]+$ing[$k][3];
				array_push($nombres,$this->requestAction("/engineers/getName/".$k)." (".$suma.")");
							
			
			}	
				$j++;
		}
		$this->set("nombres",$nombres);
		$this->layout = "ajax";

	}
	function reunionesporfilial(){
		
		$filials = $this->Filial->find("list",array("conditions"=>array("Filial.id <="=> 3)));
		$engineers = array();
		foreach($filials as $key => $value){
			
			$engineers[$value] = $this->Engineer->find("list",array("conditions"=>array("Engineer.filial_id" =>$key)));
		}

		$estados = array(6,11,9,10); 
		//planificacion, taller, grupo evaluador, GRUPO MEJORA
		//Filiales: 0->FCEL, 1->BASA, 2->FVAL
		
		$ing = array();
		$j =0;
		foreach($engineers as $key => $value){
			foreach ($value as $k=>$v){
				$i = array();
				$suma = 0;
				foreach($estados as $e){
					array_push($i,$this->Tworeport->find("count",array("conditions"=>array("Tworeport.activity_id"=>$e,"Tworeport.engineer_id"=>$k))));
					
			
				}
				$ing[$key][$k] = $i;

				
			}
				$j++;
		}
		//pr($ing);
		$filiales = array();
		$nombres = array();
			$cero = 0;
			$uno = 0;
			$dos = 0;
			$tres = 0;


	foreach($ing as $key => $value){

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
			
		$this->set("nombres",$nombres);
		$this->layout = "ajax";


		
	}
	function radial($id = null){
		$this->layout = 'ajax';		
		if($id){
			$fecha =$this->Tworeport->query("SELECT distinct(date_format(fecha, '%Y-%m')) as fecha from tworeports where fecha < now() order by fecha desc Limit 4");
			$fe = array();
			foreach($fecha as $fee){
				foreach($fee as $f){
					array_push($fe,$f);
				}			

			}
			$fecha = $fe;
			$talleres = array();
			$evaluadores = array();
			$mejoras = array();
			$planificaciones = array();
			$data2 = array();
			$fechas = array();
			$meses = array("","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
			foreach($fecha as $f){
				$data = array();
				$string = explode("-",$f["fecha"]);
				array_push($fechas,$meses[intval($string[1])]." de ".$string[0]);
				//echo $f["fecha"];
				$taller = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.activity_id"=>11,"Tworeport.fecha LIKE '".$f["fecha"]."-%'","Tworeport.engineer_id"=>$id,"Tworeport.state_id"=>2)));
				$evaluador = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.activity_id"=>9,"Tworeport.fecha LIKE '".$f["fecha"]."-%'","Tworeport.engineer_id"=>$id,"Tworeport.state_id"=>2)));
				$mejora = $this->Tworeport->find("count",array("conditions"=>array("Tworeport.activity_id"=>10,"Tworeport.fecha LIKE '".$f["fecha"]."-%'","Tworeport.engineer_id"=>$id,"Tworeport.state_id"=>2)));
				$planificacion= $this->Tworeport->find("count",array("conditions"=>array("Tworeport.activity_id"=>6,"Tworeport.fecha LIKE '".$f["fecha"]."-%'","Tworeport.engineer_id"=>$id,"Tworeport.state_id"=>2)));
				array_push($data,$planificacion,$evaluador,$mejora,$taller);
				array_push($data2,$data);

			}
			

			
			//pr($data2);

			//pr($fechas);
			$this->set("nombre",$this->requestAction("/engineers/getName/".$id));
			$this->set("fechas",$fechas);
			$this->set("datos",$data2);
			//$engineer = $this->Tworeport->			
			
		}

	}

}
?>
