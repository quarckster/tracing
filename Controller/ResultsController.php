<?php
App::uses('AppController', 'Controller');
/**
 * Results Controller
 *
 * @property Result $Result
 */
class ResultsController extends AppController {

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Result->create();
			if ($this->Result->save($this->request->data)) {
				$this->Session->setFlash(__('The result has been saved'));
				$call_id = $this->Result->SecondStage->field('call_id', array('id' => $this->request->data['Result']['second_stage_id']));
				$this->redirect(array('controller' => 'calls', 'action' => 'view', $call_id));
			} else {
				$this->Session->setFlash(__('The result could not be saved. Please, try again.'));
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
		$this->Result->id = $id;
		if (!$this->Result->exists()) {
			throw new NotFoundException(__('Invalid result'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Result->save($this->request->data)) {
				$this->Session->setFlash(__('The result has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The result could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Result->read(null, $id);
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
		$this->Result->id = $id;
		if (!$this->Result->exists()) {
			throw new NotFoundException(__('Invalid result'));
		}
		if ($this->Result->delete()) {
			$this->Session->setFlash(__('Result deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Result was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
