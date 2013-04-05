<?php
App::uses('AppController', 'Controller');
/**
 * TrainingsComments Controller
 *
 * @property TrainingsComment $TrainingsComment
 */
class TrainingsCommentsController extends AppController {


/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->TrainingsComment->create();
			if ($this->TrainingsComment->save($this->request->data)) {
				$this->Session->setFlash(__('The trainings comment has been saved'));
				$this->TrainingsComment->SendEmailNotification($this->request->data);
				$this->redirect($this->referer());
			} else {
				$this->Session->setFlash(__('The trainings comment could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
/*	public function edit($id = null) {
		$this->TrainingsComment->id = $id;
		if (!$this->TrainingsComment->exists()) {
			throw new NotFoundException(__('Invalid trainings comment'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->TrainingsComment->save($this->request->data)) {
				$this->Session->setFlash(__('The trainings comment has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The trainings comment could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->TrainingsComment->read(null, $id);
		}
	}*/

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
		$this->TrainingsComment->id = $id;
		if (!$this->TrainingsComment->exists()) {
			throw new NotFoundException(__('Invalid trainings comment'));
		}
		if ($this->TrainingsComment->delete()) {
			$this->Session->setFlash(__('Trainings comment deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Trainings comment was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
