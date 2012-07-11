<?php
class LogsController extends AppController {

	var $name = 'Logs';


	function index() {
		$this->Log->recursive = 0;
		$this->set('logs', $this->paginate());
		$this->Log->User->recursive = -1;
		$users = $this->Log->User->find('all');
		$userList = array();
		foreach($users as $u){
			$userList[$u['User']['id']]=$u['User']['username'];
		}
		$this->set('user', $userList);
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid log', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('log', $this->Log->read(null, $id));
	}

	function add() {
			
		if (!empty($this->data)) {
		pr($this->data);
		/*
		Array
		(
    [Log] => Array
        (
            [user_id] => 1
            [page] => Ã±safjajs
            [data] => lkngfaklfnsa
        )

		)
		*/
			exit();
			$this->Log->create();
			if ($this->Log->save($this->data)) {
				$this->Session->setFlash(__('The log has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The log could not be saved. Please, try again.', true));
			}
		}
		$users = $this->Log->User->find('list');
		$this->set(compact('users'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid log', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Log->save($this->data)) {
				$this->Session->setFlash(__('The log has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The log could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Log->read(null, $id);
		}
		$users = $this->Log->User->find('list');
		$this->set(compact('users'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for log', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Log->delete($id)) {
			$this->Session->setFlash(__('Log deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Log was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	function recordActivity($user,$data,$page){
		$this->Log->create();
		$log = array();
		$log['Log']['user_id']=$user;
		$log['Log']['page'] = $page;
		$log['Log']['data'] = $data;
		pr($log);
		//$this->Log->save($log);
		
	}

}
?>
