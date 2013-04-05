<?php
class DetailsController extends AppController {

	var $name = 'Details';
/*	var $helpers = array('Html','Ajax','Javascript');
	var $components = array( 'RequestHandler' );*/

	public function isAuthorized($user) {
		// All registered users can add posts
		if (in_array($this->action, array('add', 'delete')))  {
			return true;
		}
		return parent::isAuthorized($user);
	}

	public function delete($id = null) {
		$this->Detail->id = $id;
		$details = $this->Detail->find('first', array('recursive' => -1, 'conditions' => array('Detail.id' => $id), 'fields' => array('Detail.incident_id', 'Detail.comment_id', 'Detail.user_sid')));
		$incident_id = $details['Detail']['incident_id'];
		$comment_id = $details['Detail']['comment_id'];
		$displayname = $details['Detail']['user_sid'];
		$this->Detail->delete($id);
		foreach ($this->Detail->find('all', array('fields' => array('Detail.id', 'Detail.incident_id', 'Detail.comment_id'), 'conditions' => array('Detail.incident_id' => $incident_id, 'Detail.comment_id >' => $comment_id))) as $detail):
			$this->Detail->id = $detail['Detail']['id'];				
			$new_comment_id =  $detail['Detail']['comment_id'] - 1;
			$this->Detail->saveField('comment_id', $new_comment_id);
		endforeach;
		$this->redirect($this->referer());
	}
	
	public function add($id = null, $order = null) {
		$this->Detail->id = $id;
		$incident_id = $this->Detail->field('incident_id');
		$comment_id = $this->Detail->field('comment_id');
		if ($order == 'after') {
			foreach ($this->Detail->find('all', array('fields' => array('Detail.id', 'Detail.incident_id', 'Detail.comment_id'), 'conditions' => array('Detail.incident_id' => $incident_id, 'Detail.comment_id >=' => $comment_id + 1))) as $detail):
				$this->Detail->id = $detail['Detail']['id'];				
				$new_comment_id = $detail['Detail']['comment_id'] + 1;
				$this->Detail->saveField('comment_id', $new_comment_id);
			endforeach;
			unset($id);
			$this->Detail->create();
			$this->Detail->save(array('incident_id' => $incident_id, 'comment_id' => $comment_id + 1, 'comment_date' => null, 'notify_only' => 0), array('fieldList' => array('incident_id', 'comment_id', 'comment_date', 'notify_only')));
		}
		if ($order == 'before') {
			foreach ($this->Detail->find('all', array('fields' => array('Detail.id', 'Detail.incident_id', 'Detail.comment_id'), 'conditions' => array('Detail.incident_id' => $incident_id, 'Detail.comment_id >=' => $comment_id))) as $detail):
				$this->Detail->id = $detail['Detail']['id'];				
				$new_comment_id = $detail['Detail']['comment_id'] + 1;
				$this->Detail->saveField('comment_id', $new_comment_id);
			endforeach;
			unset($id);
			$this->Detail->create();
			$this->Detail->save(array('incident_id' => $incident_id, 'comment_id' => $comment_id, 'comment_date' => null, 'notify_only' => 0), array('fieldList' => array('incident_id', 'comment_id', 'comment_date', 'notify_only')));
		}
		$this->redirect($this->referer());
	}

	/*function edit($id = null) {

		$incident_id = $this->Detail->field('incident_id');

		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Неверный комментарий', true));
			$this->redirect(array('controller' => 'incidents', 'action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Detail->save($this->data)) {
				$this->Session->setFlash(__('Изменения сохранены', true));
				$this->redirect($this->referer());
			} else {
				$this->Session->setFlash(__('Сохранение не удалось. Попробуйте ещё раз.', true));
			}
		}
		if (empty($this->data)) {
				
				$this->set('incident', $this->Detail->find('all', array('conditions' => array('incident_id' => $incident_id, 'notify_only ' => '0'))));
		}
	
	}
*/
}
?>
