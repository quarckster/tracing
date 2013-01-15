<?php
App::uses('AppController', 'Controller');
/**
 * SecondStages Controller
 *
 * @property SecondStage $SecondStage
 */
class SecondStagesController extends AppController {
	public $components = array('Search.Prg');
	public $paginate = array(
		'limit' => 25,
		'order' => array('SecondStage.id' => 'desc')
	);

	public $presetVars = array(
		array('field' => 'order_number', 'type' => 'value', 'empty' => True)
	);
	
	public function find() {
		$this->Prg->commonProcess();
		$this->paginate['conditions'] = $this->SecondStage->parseCriteria($this->passedArgs);
		$this->set('secondStages', $this->paginate());
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->SecondStage->recursive = 1;
		$this->set('secondStages', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->SecondStage->id = $id;
		if (!$this->SecondStage->exists()) {
			throw new NotFoundException(__('Invalid second stage'));
		}
		$this->SecondStage->recursive = 1;
		$this->set('secondStage', $this->SecondStage->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->SecondStage->create();
			if ($this->SecondStage->save($this->request->data)) {
				$this->Session->setFlash(__('The second stage has been saved'));
				$this->redirect(array('controller' => 'calls', 'action' => 'view', $this->request->data['SecondStage']['call_id']));
			} else {
				$this->Session->setFlash(__('The second stage could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->SecondStage->id = $id;
		if (!$this->SecondStage->exists()) {
			throw new NotFoundException(__('Invalid second stage'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->SecondStage->saveAssociated($this->request->data)) {
				$this->Session->setFlash(__('The second stage has been saved'));
				$this->redirect(array('action' => 'view', $this->data['SecondStage']['id']));
			} else {
				$this->Session->setFlash(__('The second stage could not be saved. Please, try again.'));
				$this->redirect(array('action' => 'view', $this->data['SecondStage']['id']));
			}
		} else {
			$this->request->data = $this->SecondStage->read(null, $id);
		}
	}

/**
 * delete method
 *
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		// if (!$this->request->is('post')) {
		// 	throw new MethodNotAllowedException();
		// }
		$this->SecondStage->id = $id;
		if (!$this->SecondStage->exists()) {
			throw new NotFoundException(__('Invalid second stage'));
		}
		if ($this->SecondStage->delete()) {
			$this->Session->setFlash(__('Second stage deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Second stage was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
