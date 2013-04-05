<?php
App::uses('AppController', 'Controller');
/**
 * Trainings Controller
 *
 * @property Training $Training
 */
class TrainingsController extends AppController {

	public $components = array('Search.Prg');

	public $paginate = array();
	
	public $presetVars = array(
		array('field' => 'user_sid', 'type' => 'value', 'empty' => True),
		array('field' => 'id', 'type' => 'value', 'empty' => True),
		array('field' => 'filter', 'type' => 'value', 'empty' => True),
		array('field' => 'range.array', 'type' => 'value', 'empty' => True),
		array('field' => 'range_from', 'type' => 'value', 'empty' => True),
		array('field' => 'range_to', 'type' => 'value', 'empty' => True),
		array('field' => 'number_to', 'type' => 'value', 'empty' => True),
		array('field' => 'town', 'type' => 'value', 'empty' => True),
		array('field' => 'purpose', 'type' => 'value', 'empty' => True)
	);

	public function find() {
		$this->Prg->commonProcess();
		$this->Training->validate = null;
		$this->Training->recursive = 0;
		$this->Training->order = 'Training.id DESC';
		$this->paginate['conditions'] = $this->Training->parseCriteria($this->passedArgs);
		$this->set('trainings', $this->paginate());
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Training->recursive = 0;
		$this->Training->order = 'Training.id DESC';
		$this->set('trainings', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Training->id = $id;
		if (!$this->Training->exists()) {
			throw new NotFoundException(__('Invalid training'));
		}
		$this->set('training', $this->Training->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Training->create();
			if ($this->Training->saveAssociated($this->request->data)) {
				$this->Session->setFlash(__('The training has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The training could not be saved. Please, try again.'));
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
		$this->Training->id = $id;
		if (!$this->Training->exists()) {
			throw new NotFoundException(__('Invalid training'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Training->saveAssociated($this->request->data)) {
				$this->Session->setFlash(__('The training has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The training could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Training->read(null, $id);
		}
	}

/**
 * delete method
 *
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Training->id = $id;
		if (!$this->Training->exists()) {
			throw new NotFoundException(__('Invalid training'));
		}
		if ($this->Training->delete()) {
			$this->Session->setFlash(__('Training deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Training was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}