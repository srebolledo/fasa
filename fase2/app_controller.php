<?php
  class AppController extends Controller {
    var $components = array('Acl', 'Auth','Session',"RequestHandler");
    var $helpers = array('Html', 'Form', 'Session');
    var $uses = array('Log');
    var $_css_before = array('base','pages.home');
    var $_css_after = array('jquery.menu','cake.generic','smoothness/jquery');
    var $_js_before = array('base','jquery','jquery-ui','jquery.menu','highcharts');
    var $_js_after = array();	

    function beforeFilter(){
      $this->set("title_for_layout","| Sistema de reportes");
      //Configure AuthComponent
      $this->Auth->allow(array("login","logout",'recordActivity'));
      //$this->Auth->allow(array("*"));
      $this->Auth->authorize = 'actions';
      $this->Auth->loginAction = array('controller' => 'users', 'action' => 'login');
      //$this->Auth->logoutRedirect = array('controller' => 'pages', 'action' => 'home');
      $this->Auth->loginRedirect = array('controller' => 'pages', 'action' => 'display');
    }
	
	
    function beforeRender(){
      //distintos menus
      if($user = $this->Session->read('Auth.User')){
	switch($user['group_id']){
	  default:
	    Configure::load( 'menus_admin' );
	    $this->set( 'menus', Configure::read( 'Menus' ) );					
	  break;
	  case '2':
	    Configure::load( 'menus_ingeniero' );
	    $this->set( 'menus', Configure::read( 'Menus' ) );					
	  break;
	}
      }
      // Automatic CSS and scripts loading
      $auto = array(
	'layout.'.$this->layout,
	  $this->params['controller'],
	  $this->params['controller'].'.'.$this->params['action'],
      );
      $this->set( 'css_for_layout', array_unique( am(
	$this->_css_before, $auto, $this->_css_after
	) ) );
      $this->set( 'js_for_layout', array_unique( am(
	$this->_js_before, $auto, $this->_js_after
      ) ) );  			
    }
	
	
    function loguea($datos,$page){
	    $this->Log->create();
	    $log = array();
	    if($this->Session->read("Auth.User")){
	      $usuario=$this->Session->read("Auth.User");
	      $log['Log']['user_id']=$usuario['id'];
	      $log['Log']['page'] = $page;
	      $log['Log']['data'] = serialize($datos);
	      $this->Log->save($log);
	    }
    }
    function datepicker($fecha){
    	echo $fecha;
    
    }
  }
?>
