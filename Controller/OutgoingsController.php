<?php
App::uses('AppController', 'Controller');
/**
 * Outgoings Controller
 *
 * @property Outgoing $Outgoing
 */
class OutgoingsController extends AppController {

	public $layout = 'generic';

	public $components = array('Search.Prg');

	public $presetVars = array(
		array('field' => 'executer', 'type' => 'value'),
		array('field' => 'outgoing_num', 'type' => 'value'),
		array('field' => 'organization', 'type' => 'value'),
		array('field' => 'filter', 'type' => 'value'),
		array('field' => 'range.array', 'type' => 'value'),
		array('field' => 'folder', 'type' => 'value'),
		array('field' => 'cis', 'type' => 'value'),
		array('field' => 'content', 'type' => 'value')
	);

	public $paginate = array(
	'limit' => 25,
	'order' => array(
    	'Outgoing.id' => 'desc'
	)
	);
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Outgoing->recursive = 0;
		$this->set('outgoings', $this->paginate());
	}

	public function find() {
		$this->Prg->commonProcess();
		$this->paginate['conditions'] = $this->Outgoing->parseCriteria($this->passedArgs);
		$this->set('outgoings', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Outgoing->id = $id;
		if (!$this->Outgoing->exists()) {
			throw new NotFoundException(__('Invalid outgoing'));
		}
		$this->set('outgoing', $this->Outgoing->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Outgoing->create();
			//$this->request->data['Outgoing']['date'] = date('Y-m-d');
			if ($this->Outgoing->save($this->request->data)) {
				$this->Session->setFlash(__('The outgoing has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The outgoing could not be saved. Please, try again.'));
			}
		} else {
			$this->set('outgoing_numbers', $this->Outgoing->findLastNum()); //Выводим номера последних входящих
		}
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Outgoing->id = $id;
		if (!$this->Outgoing->exists()) {
			throw new NotFoundException(__('Invalid outgoing'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Outgoing->save($this->request->data)) {
				$this->Session->setFlash(__('The outgoing has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The outgoing could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Outgoing->read(null, $id);
		}
	}

/**
 * delete method
 *
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Невер­ное входящее', 'message', array('heading' => 'Ошибка', 'class' => 'alert alert-error span2'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Outgoing->delete($id, true);
		$this->Session->setFlash('Входящее удален­о', 'message', array('class' => 'alert alert-warning span2'));
		$this->redirect(array('action' => 'index'));
	}

}