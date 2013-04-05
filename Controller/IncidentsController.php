<?php
App::uses('AppController', 'Controller');
/**
 * Incidents Controller
 *
 * @property Incident $Incident
 * @property 'AuthComponent $'Auth
 * @property Paginator'Component $Paginator'
 */
class IncidentsController extends AppController {

	public $layout = 'generic';

/**
 * Helpers
 *
 * @var array
 */
	public $helpers = array('Paginator', 'Text');
/**
 * Components
 *
 * @var array
 */
	public $components = array('Email', 'Search.Prg', 'RequestHandler');
	
	public $presetVars = array(
		array('field' => 'user_sid', 'type' => 'value', 'empty' => True),
		array('field' => 'incoming_num', 'type' => 'value', 'empty' => True),
		array('field' => 'organization', 'type' => 'value', 'empty' => True),
		array('field' => 'filter', 'type' => 'value', 'empty' => True),
		array('field' => 'range.array', 'type' => 'value', 'empty' => True),
		array('field' => 'range_from', 'type' => 'value', 'empty' => True),
		array('field' => 'range_to', 'type' => 'value', 'empty' => True),
		array('field' => 'number_to', 'type' => 'value', 'empty' => True),
		array('field' => 'content', 'type' => 'value', 'empty' => True),
		array('field' => 'exp_date', 'type' => 'value', 'empty' => True)
	);
	
    	public $paginate = array(
		'limit' => 25,
		'conditions' => 'Incident.incoming_num != -1',
		'fields' => array('Incident.id', 'Incident.incoming_num', 'Incident.organization', 'Incident.start_date', 'Incident.exp_date', 'Incident.number_to'),
		'order' => array(
	    	'Incident.id' => 'desc'
		)
    	);
    	
    	public function isAuthorized($user) {
		if ($this->action === 'edit') {
			return true;
		}
		return parent::isAuthorized($user);
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
    if ($this->RequestHandler->isRss() ) {
    	$this->Incident->recursive = 1;
        $incidents = $this->Incident->find('all', array('limit' => 100, 'order' => 'Incident.id DESC'));
        return $this->set(compact('incidents'));
    }
		$this->Incident->recursive = -1;
		$this->set('incidents', $this->paginate());
	}
	
	public function find() {
		$this->Prg->commonProcess();
	    if ($this->RequestHandler->isRss() ) {
	    	$this->Incident->recursive = 1;
	        $incidents = $this->Incident->find('all', array('order' => 'Incident.id DESC', 'conditions' => $this->Incident->parseCriteria($this->passedArgs)));
	        return $this->set(compact('incidents'));
	    }
		$this->paginate['conditions'] = $this->Incident->parseCriteria($this->passedArgs);
		$this->set('incidents', $this->paginate());
	}

	public function user_filter($user_sid) {
	    if ($this->RequestHandler->isRss() ) {
	        $incidents = $this->Incident->user_filter($user_sid);
	        return $this->set(compact('incidents', 'user_sid'));
	    }
		$incidents = $this->Incident->user_filter($user_sid);
		$this->set('incidents', $incidents);
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('Невер­ное входящее', 'message', array('heading' => 'Ошибка', 'class' => 'alert alert-error span2'));
			$this->redirect(array('action' => 'index'));
		}
		//$this->set('user', $this->Auth->user('username'));
		$this->set('incident', $this->Incident->read(null, $id));
		$this->set('min_comment_id', $this->Incident->Detail->field('Detail.comment_id', array('Detail.incident_id' => $id, 'Detail.comment' => '', 'Detail.notify_only !=' => '-1'), 'Detail.comment_id ASC'));
	}

/**
 * history method
 *
 * @param string $id
 * @return void
 */
	public function history($id = null) {
		$this->Incident->id = $id;
		$history = $this->Incident->revisions(null, true);
		$details_history = $this->Incident->Detail->DetailsRev->find('all', array('conditions' => array('incident_id' => $id)));
		if((count($history) == 1) && (isset($details_history) && count($details_history) == 0)) {
			$this->Session->setFlash('Никто не редактировал данные по этому письму', 'message', array('heading' => 'Ошибка', 'class' => 'alert alert-error span4'));
			$this->redirect($this->referer());
		}
		//$this->set('changes', $this->Incident->diff());
		$this->set('details_histories', $details_history);
		$this->set('histories', $history);
		$this->set('id', $id);
		$this->set('incoming_num', $this->Incident->field('incoming_num', array('id' => $id)));

	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Incident->create();
			$this->request->data['Incident']['user_sid'] = $this->Auth->user('user_sid');
			$this->request->data['Incident']['start_date'] = date('Y-m-d H:m');
			if (!empty($this->request->data['Detail']['notify'])) {
				$n = count($this->request->data['Detail']);
				$notified_arr = explode(', ', $this->request->data['Detail']['notify']);
				foreach ($notified_arr as $notified) {
					$this->request->data['Detail'][$n]['user_sid'] = $notified;
					$this->request->data['Detail'][$n]['notify_only'] = 1;
					$n++;
				}
			}
			unset($this->request->data['Detail']['notify']);
			if ($this->Incident->saveAll($this->request->data)) {
				if (!empty($this->request->data['Detail'])) {
					$incident_id = $this->Incident->id;
					$displayname = $this->request->data['Detail'];
					$this->Incident->SendEmailNotification($displayname, null, $incident_id, 'new_mail');
				}			
				$this->Session->setFlash('Входящее добавлено', 'message', array('heading' => 'Успех', 'class' => 'alert alert-success span2'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('Сохран­е­ние н­е удалось. Попробуйте ещё раз.', 'message', array('heading' => 'Ошибка', 'class' => 'alert alert-error span4'));
			}
		} else {
			$this->set('incoming_numbers', $this->Incident->findLastIncomingNum());
		}
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
 	public function edit($id = null) {
 		$this->Incident->id = $id;
		if (!$this->Incident->exists()) {
			throw new NotFoundException(__('Невер­ное входящее'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Incident->saveAssociated($this->request->data)) {
				$old_displayname = $this->Incident->Detail->find('first', array('recursive' => -1, 'conditions' => array('Detail.incident_id' => $this->data['Incident']['id'], 'Detail.comment' => '', 'Detail.notify_only !=' => 1 ))); //Находим первого участника с пустым комментарием из базы
				if (!empty($old_displayname)) {
					$new_displayname = array_shift($this->request->data['Detail']); // Вычленяем первый элемент массива
				}
				if (isset($new_displayname) && ($old_displayname != $new_displayname)) { // Провереям и сравниваем значения для уведомления участника
					$this->Incident->SendEmailNotification($new_displayname['user_sid'], $new_displayname['id'], $this->data['Incident']['id'], 'edit_incident');
				}
				$this->Session->setFlash(__('Изме­не­ния сохранен­ы'));
				$this->redirect(array('action' => 'view', $this->data['Incident']['id']));
			} else {
				$this->Session->setFlash('Сохран­е­ние н­е удалось. Попробуйте ещё раз.', 'message', array('heading' => 'Ошибка', 'class' => 'alert alert-error span2'));
			}
		} else {
			$this->request->data = $this->Incident->find('all', array('conditions' => array('Incident.id' => $id)));
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
		$this->Incident->delete($id, true);
		$this->Session->setFlash('Входящее удален­о', 'message', array('class' => 'alert alert-warning span2'));
		$this->redirect(array('action' => 'index'));
	}
	
	public function edit_comment() {
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->Incident->Detail->id = $this->request->data['Detail']['id'];
			$this->request->data['Detail']['comment_date'] = date('Y-m-d G:i:s');
			//if ($this->Incident->Detail->saveField('comment', $this->data['Detail']['comment'])) {
			if ($this->Incident->Detail->save($this->request->data)) {
				$incident_id = $this->request->data['Detail']['incident_id'];
				$next_comment_id = $this->request->data['Detail']['comment_id'] + 1;
				$next = $this->Incident->Detail->find('first', array('recursive' => -1, 'conditions' => array('Detail.incident_id' => $incident_id, 'Detail.comment_id' => $next_comment_id)));
				if (!empty($next) && $next['Detail']['notify_only'] != 1) {
					$displayname = $next['Detail']['user_sid'];
					$detail_id = $next['Detail']['id'];
					$this->Incident->SendEmailNotification($displayname, $detail_id, $incident_id, 'new_comment');
				}
				$this->Session->setFlash('Изме­не­ния сохранен­ы', 'message', array('heading' => 'Успех', 'class' => 'alert alert-success span2'));
				$this->redirect(array('action' => 'view', $incident_id));
			} else {
				$this->Session->setFlash('Сохран­ен­ие н­е удалось. Попробуйте ещё раз.', 'message', array('heading' => 'Ошибка', 'class' => 'alert alert-error span2'));
			}
		} else {
				$incident_id = $this->params['named']['incident_id'];
				$detail_id = $this->params['named']['detail_id'];	
				$this->set('incident', $this->Incident->read(null, $incident_id));
				$this->set('detail_id', $detail_id);//Передаём id комме­нтария, чтобы потом сравн­ить для отображен­ия поля ввода
		}
	}
}
