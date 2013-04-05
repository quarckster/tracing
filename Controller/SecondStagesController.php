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
		array('field' => 'order_number', 'type' => 'value', 'empty' => True),
		array('field' => 'filter', 'type' => 'value', 'empty' => True),
		array('field' => 'order_in', 'type' => 'value', 'empty' => True),
		array('field' => 'category', 'type' => 'value', 'empty' => True)
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
				$this->Session->setFlash('Второй этап добавлен', 'message', array('heading' => 'Успех', 'class' => 'alert alert-success span2'));
				$this->redirect(array('controller' => 'calls', 'action' => 'view', $this->request->data['SecondStage']['call_id']));
			} else {
				$this->Session->setFlash('Сохран­е­ние н­е удалось. Попробуйте ещё раз.', 'message', array('heading' => 'Ошибка', 'class' => 'alert alert-error span4'));
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
				$this->Session->setFlash('Изме­не­ния сохранен­ы', 'message', array('heading' => 'Успех', 'class' => 'alert alert-success span2'));
				$this->redirect(array('action' => 'view', $this->data['SecondStage']['id']));
			} else {
				$this->Session->setFlash('Сохран­е­ние н­е удалось. Попробуйте ещё раз.', 'message', array('heading' => 'Ошибка', 'class' => 'alert alert-error span4'));
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
			$this->Session->setFlash('Второй этап удалён', 'message', array('class' => 'alert alert-warning span2'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('Ошибка', 'message', array('heading' => 'Ошибка', 'class' => 'alert alert-error span2'));
		$this->redirect(array('action' => 'index'));
	}
}
