<?php
class ProjectsController extends AppController {

	var $name = 'Projects';
	var $uses = array("Project","Projectfile","Onereport");

	function index() {
		$this->Project->recursive = 0;
		$this->set('projects', $this->paginate());
		parent::loguea($this->data,$this->here);
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid project', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('project', $this->Project->read(null, $id));
		parent::loguea($this->data,$this->here);
	}

	function add($id = null,$projectID = null) {
		if (!empty($this->data)) {
				if(!empty($this->data['Project']['projectID'])){
					$projectID = $this->data['Project']['projectID'];

				}
				
				if($this->data["Projectfile"]["filename"]["error"] != 0){
					$this->Session->setFlash("El archivo no ha podido ser guardado. Intente nuevamente");
				}
	
				if(!empty($this->data["Projectfile"]["filename"]["tmp_name"])){
					$usuario = $this->Session->read("Auth.User");
					$project = $this->Project->find("all",array("conditions"=>array("Project.onereport_id"=>$this->data["Project"]["onereport_id"])));

					if($project){
						$project_id = $project[0]["Project"]["id"];
					}
					if(isset($projectID) && $projectID != null){				
					$sql = "SELECT count(*) as veces FROM `projectfiles` WHERE `project_id` = $project_id";
					$version = $this->Projectfile->query($sql);
					$version = $version[0][0]['veces']+1;
					
					}
					else{
						$version = 1;				
					}
					if($this->data["Project"]["nombre"]){
						$nombre = $this->data["Project"]["nombre"];
			
					}
					else{
						$project = $this->Project->read(null,$projectID);
						$nombre = $project['Project']['nombre'];

					}
						$editor = $this->requestAction("/engineers/getName/".$this->requestAction("/engineers/getId/".$usuario["id"]));
					$usuario = $this->Session->read('Auth.User');
					if($usuario['group_id'] == 3 || $usuario['group_id'] == 6){
						if($version >1){
							$version = $version -1;
							$version = $version."-corregido";				
						}
						else{
							$version = $version."-corregido";
						}
					}
				
					$extension = explode(".",$this->data["Projectfile"]["filename"]["name"]);
					$extension = $extension[count($extension)-1];
					$nombreArchivo = date("Y-m-d")." ".$editor."-".$nombre."-v".$version.".".$extension;
					if(move_uploaded_file($this->data["Projectfile"]["filename"]["tmp_name"],getcwd()."/projects/".$nombreArchivo)){
				$this->Project->create();
				if(empty($projectID)){
					if ($this->Project->save($this->data)) {
						$idProject = $this->Project->id;
						$projectfile = array();
					$sql = "SELECT count(*) as veces FROM `projectfiles` WHERE `project_id` = $idProject";
					$version = $this->Projectfile->query($sql);
					$version = $version[0][0]['veces']+1;
					$extension = explode(".",$this->data["Projectfile"]["filename"]["name"]);
					$extension = $extension[count($extension)-1];
					$nombreArchivo = date("Y-m-d")." ".$this->requestAction("/engineers/getName/".$this->requestAction("/engineers/getId/".$usuario["id"]))."-".$this->data["Project"]["nombre"]."-v".$version.".".$extension;
						$projectfile["filename"] = $nombreArchivo;
						$projectfile["project_id"] = $idProject;
						$projectfile["order"] = 1;					
						$this->Project->Projectfile->save($projectfile);
						$onereport = $this->Onereport->read(null,$this->data["Project"]["onereport_id"]);
						$onereport["Onereport"]["proyectostate_id"] = 2;
						$onereport["Onereport"]["proyectofecha"] = date("Y-m-d");
						$this->Onereport->save($onereport);
						parent::loguea($this->data,$this->here);
						$this->Session->setFlash(__('El proyecto ha sido agregado con éxito', true));
						if($usuario['group_id'] == 3 || $usuario['group_id'] ==6){
							$this->redirect(array('controller'=>'onereports','action' => 'misIdeas'));	
						}
						else{
							$this->redirect(array('controller'=>'onereports','action' => 'abiertas'));
						}
					} else {
						$this->Session->setFlash(__('The project could not be saved. Please, try again.', true));
					}
				}
				else{
						$projectfile = array();
						$project = $this->Project->read(null,$projectID);
						
						$nombreArchivo = $nombreArchivo = date("Y-m-d")." ".$this->requestAction("/engineers/getName/".$this->requestAction("/engineers/getId/".$usuario["id"]))."-".$project['Project']['nombre']."-v".$version.".".$extension;

						$projectfile["filename"] = $nombreArchivo;
						$projectfile["project_id"] = $projectID;
						$projectfile["order"] = 1; //deprecated					
						$this->Project->Projectfile->save($projectfile);
						$onereport = $this->Onereport->read(null,$this->data["Project"]["onereport_id"]);
						//$onereport["Onereport"]["proyectostate_id"] = 2;
						//$onereport["Onereport"]["proyectofecha"] = date("Y-m-d");
						//$this->Onereport->save($onereport);
						$this->Session->setFlash(__('El proyecto ha sido agregado con éxito', true));
						if($usuario['group_id'] == 3 || $usuario['group_id'] ==6){
							$this->redirect(array('controller'=>'onereports','action' => 'misIdeas'));	
						}
						else{
							$this->redirect(array('controller'=>'onereports','action' => 'abiertas'));
						}


			}		
			echo "Archivo subido";

		}	
			else{
				echo "Archivo no subido";
			}
			
									
		
				}

						
		
		}
	

		if(!$id){
			$this->Session->setFlash("No ha seleccionado ningún proyecto");
			$this->redirect(array("controller"=>"onereports","action"=>"abiertas"));

		}
		
		else{
			
			$projecttypes = $this->Project->Projecttype->find('list');
			$onereports = $this->Project->Onereport->find('all');
			$this->set('info',true);
			$this->set(compact('onereports','projecttypes','id'));
			if($projectID){
				$this->set('projectID',$projectID);
				$this->set('info',false);
			}
		}


	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid project', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Project->save($this->data)) {
				$this->Session->setFlash(__('The project has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The project could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Project->read(null, $id);
		}
		$onereports = $this->Project->Onereport->find('list');
		$this->set(compact('onereports'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for project', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Project->delete($id)) {
			$this->Session->setFlash(__('Project deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Project was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>
