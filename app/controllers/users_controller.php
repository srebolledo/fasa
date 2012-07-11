<?php
class UsersController extends AppController {

	var $name = 'Users';
	var $uses = array("User","Engineer","Filial");
//para auth con acl
/**
 * Reconstruye el Acl basado en los controladores actuales de la aplicación.
 *
 * @return void
 */
    function buildAcl() {
        $log = array();
 
        $aco =& $this->Acl->Aco;
        $root = $aco->node('controllers');
        if (!$root) {
            $aco->create(array('parent_id' => null, 'model' => null, 'alias' => 'controllers'));
            $root = $aco->save();
            $root['Aco']['id'] = $aco->id; 
            $log[] = 'Creado el nodo Aco para los controladores';
        } else {
            $root = $root[0];
        }   
 
        App::import('Core', 'File');
        $Controllers = Configure::listObjects('controller');
        $appIndex = array_search('App', $Controllers);
        if ($appIndex !== false ) {
            unset($Controllers[$appIndex]);
        }
        $baseMethods = get_class_methods('Controller');
        $baseMethods[] = 'buildAcl';
 
        // miramos en cada controlador en app/controllers
        foreach ($Controllers as $ctrlName) {
            App::import('Controller', $ctrlName);
            $ctrlclass = $ctrlName . 'Controller';
            $methods = get_class_methods($ctrlclass);
 
            //buscar / crear nodo de controlador
            $controllerNode = $aco->node('controllers/'.$ctrlName);
            if (!$controllerNode) {
                $aco->create(array('parent_id' => $root['Aco']['id'], 'model' => null, 'alias' => $ctrlName));
                $controllerNode = $aco->save();
                $controllerNode['Aco']['id'] = $aco->id;
                $log[] = 'Creado el nodo Aco del controlador '.$ctrlName;
            } else {
                $controllerNode = $controllerNode[0];
            }
 
            //Limpieza de los metodos, para eliminar aquellos en el controlador 
            //y en las acciones privadas
            foreach ($methods as $k => $method) {
                if (strpos($method, '_', 0) === 0) {
                    unset($methods[$k]);
                    continue;
                }
                if (in_array($method, $baseMethods)) {
                    unset($methods[$k]);
                    continue;
                }
                $methodNode = $aco->node('controllers/'.$ctrlName.'/'.$method);
                if (!$methodNode) {
                    $aco->create(array('parent_id' => $controllerNode['Aco']['id'], 'model' => null, 'alias' => $method));
                    $methodNode = $aco->save();
                    $log[] = 'Creado el nodo Aco para '. $method;
                }
            }
        }
        debug($log);
    }

/////


function initDB() {
    $group =& $this->User->Group;
    //Permite a los administradores hacer todo
    $group->id = 1;     
    $this->Acl->allow($group, 'controllers');

    //permite a los editores postear y accesar los widgets
    $group->id = 2;
    $this->Acl->deny($group, 'controllers');
    $this->Acl->allow($group,'controllers/Users/login');
    $this->Acl->allow($group,'controllers/Users/view');
    $this->Acl->allow($group,'controllers/Users/logout');
}





//end auth con acl
	function beforeFilter() {
		parent::beforeFilter(); 
		//$this->Auth->allowedActions = array('*');
		
	}

	function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
		parent::loguea($this->data,$this->here);
	}

	function login(){
		$this->layout = "notlogged";
		if ($this->Session->read('Auth.User')) {
				$this->Session->setFlash('Ha iniciado sesión');
				$this->redirect('/', null, false);
		}
		parent::loguea($this->data,$this->here);

		
		
	}
	
	function logout(){

		$this->Session->setFlash('Usted ha sido desconectado exitosamente');
		$this->redirect($this->Auth->logout());
		
	}




	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Usuario no válido', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('user', $this->User->read(null, $id));
		parent::loguea($this->data,$this->here);
	}

	function add() {
		if (!empty($this->data)) {
			$this->User->create();
			if ($this->User->save($this->data)) {
				$this->data["Engineer"]["user_id"] = $this->User->id;
				$this->Engineer->save($this->data);
				parent::loguea($this->data,$this->here);
				$this->Session->setFlash(__('The user has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
			}
		}
		$filials = $this->Filial->find("list");
		$engineers = $this->User->Engineer->find("list");
		$groups = $this->User->Group->find('list');
		$this->set(compact('groups',"engineers","filials"));
	}

	function editar_info(){
		if(!empty($this->data)){
			$pass1 = $this->data['User']['password'];
			$pass2 = $this->data['User']['password2'];
			$email = $this->data['User']['email'];
			$id = $this->Session->read('Auth.User.id');
			$this->data = $this->User->read(null,$id);

			if($pass1 == $pass2 && $pass1 != '' && $pass2 != ''){
				$clave = $this->Auth->password($pass1);
				$this->data['User']['password'] = $clave;
			}
			if($email != ''){
				//$this->data['User']['password'] = $clave; Poner el email acá
			
			}		
			
			if($this->User->save($this->data)){
				$this->Session->setFlash(__('Ha modificado correctamente su información', true));
				$this->redirect(array('controller'=>'pages','action' => 'display'));
			}
			else{
				$this->Session->setFlash(__('Ha ocurrido un error, por favor contáctese con el administrador', true));
			
			}			
		
		}
		else{
			$id = $this->Session->read('Auth.User.id');
			$this->data = $this->User->read(null,$id);
		}
	
	
	}


	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->User->save($this->data)) {
				parent::loguea($this->data,$this->here);
				$this->Session->setFlash(__('The user has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->User->read(null, $id);
		}
		$engineers = $this->User->Engineer->find("list");
		$groups = $this->User->Group->find('list');
		$this->set(compact('groups',"engineers"));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for user', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->User->delete($id)) {
			parent::loguea($this->data,$this->here);
			$this->Session->setFlash(__('User deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('User was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}

	//Admin Functions 
		
	function admin_login(){
		
		$this->Session->setFlash('Adios y nos vemos.');
		//$this->redirect($this->Auth->logout());

	}
	
	function admin_logout(){

	}

}
?>
