<?php
App::uses('AppController', 'Controller');
/**
 * SecondStageArchives Controller
 *
 * @property SecondStageArchive $SecondStageArchive
 */
class SecondStageArchivesController extends AppController {

	public $components = array('Search.Prg');
	public $paginate = array(
		'limit' => 25,
		'order' => array('SecondStageArchive.id' => 'desc')
	);

	public $presetVars = array(
		array('field' => 'order_number', 'type' => 'value', 'empty' => True),
		array('field' => 'contact_data', 'type' => 'value', 'empty' => True),
		array('field' => 'requisites', 'type' => 'value', 'empty' => True)
	);
	
	public function find() {
		$this->Prg->commonProcess();
		$this->paginate['conditions'] = $this->SecondStageArchive->parseCriteria($this->passedArgs);
		$this->set('secondStageArchives', $this->paginate());
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->SecondStageArchive->recursive = 0;
		$this->set('secondStageArchives', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->SecondStageArchive->id = $id;
		if (!$this->SecondStageArchive->exists()) {
			throw new NotFoundException(__('Invalid second stage archive'));
		}
		$this->set('secondStageArchive', $this->SecondStageArchive->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->SecondStageArchive->create();
			if ($this->SecondStageArchive->save($this->request->data)) {
				$this->Session->setFlash(__('The second stage archive has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The second stage archive could not be saved. Please, try again.'));
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
		$this->SecondStageArchive->id = $id;
		if (!$this->SecondStageArchive->exists()) {
			throw new NotFoundException(__('Invalid second stage archive'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->SecondStageArchive->save($this->request->data)) {
				$this->Session->setFlash(__('The second stage archive has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The second stage archive could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->SecondStageArchive->read(null, $id);
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
		$this->SecondStageArchive->id = $id;
		if (!$this->SecondStageArchive->exists()) {
			throw new NotFoundException(__('Invalid second stage archive'));
		}
		if ($this->SecondStageArchive->delete()) {
			$this->Session->setFlash(__('Second stage archive deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Second stage archive was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
