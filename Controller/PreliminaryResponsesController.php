<?php
App::uses('AppController', 'Controller');
/**
 * PreliminaryResponses Controller
 *
 * @property PreliminaryResponse $PreliminaryResponse
 */
class PreliminaryResponsesController extends AppController {

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			// debug($this->request->data);
			$this->PreliminaryResponse->create();
			if ($this->PreliminaryResponse->save($this->request->data)) {
				$this->Session->setFlash(__('The prelimiary response has been saved'));
				$call_id = $this->PreliminaryResponse->SecondStage->field('call_id', array('id' => $this->request->data['PreliminaryResponse']['second_stage_id']));
				$this->redirect(array('controller' => 'calls', 'action' => 'view', $call_id));
			} else {
				$this->Session->setFlash(__('The prelimiary response could not be saved. Please, try again.'));
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
		$this->PreliminaryResponse->id = $id;
		if (!$this->PreliminaryResponse->exists()) {
			throw new NotFoundException(__('Invalid prelimiary response'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->PreliminaryResponse->save($this->request->data)) {
				$this->Session->setFlash(__('The prelimiary response has been saved'));
				$this->redirect($this->referer());
			} else {
				$this->Session->setFlash(__('The prelimiary response could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->PreliminaryResponse->read(null, $id);
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
		$this->PreliminaryResponse->id = $id;
		if (!$this->PreliminaryResponse->exists()) {
			throw new NotFoundException(__('Invalid prelimiary response'));
		}
		if ($this->PreliminaryResponse->delete()) {
			$this->Session->setFlash(__('Prelimiary response deleted'));
			$this->redirect($this->referer());
		}
		$this->Session->setFlash(__('Prelimiary response was not deleted'));
		$this->redirect($this->referer());
	}
}
