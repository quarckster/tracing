<?php
class CallsDetailsController extends AppController {

	var $name = 'CallsDetails';

	function index() {
		$this->CallsDetail->recursive = 0;
		$this->set('callsDetails', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid calls detail', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('callsDetail', $this->CallsDetail->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->CallsDetail->create();
			if ($this->CallsDetail->save($this->data)) {
				$this->Session->setFlash(__('The calls detail has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The calls detail could not be saved. Please, try again.', true));
			}
		}
		$calls = $this->CallsDetail->Call->find('list');
		$this->set(compact('calls'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid calls detail', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->CallsDetail->save($this->data)) {
				$this->Session->setFlash(__('The calls detail has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The calls detail could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->CallsDetail->read(null, $id);
		}
		$calls = $this->CallsDetail->Call->find('list');
		$this->set(compact('calls'));
	}

	function delete($id = null) {
		$this->CallsDetail->id = $id;
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for calls detail', true));
			$this->redirect($this->referer());
		}
		if ($this->CallsDetail->delete($id)) {
			$this->Session->setFlash('Участник удалён из обращения', 'message', array('heading' => 'Успех', 'class' => 'alert alert-success span3'));
			$this->redirect($this->referer());
		}
		$this->Session->setFlash(__('Calls detail was not deleted', true));
		$this->redirect($this->referer());
	}
}
