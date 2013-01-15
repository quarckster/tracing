<?php
class CallsController extends AppController {

	public $name = 'Calls';
	public $layout = 'generic';
	public $components = array('Email', 'Search.Prg');	
	public $paginate = array(
		'limit' => 25,
		'order' => array(
    	'Call.id' => 'desc'
		)
	);
    	
	public $presetVars = array(
		array('field' => 'user_sid', 'type' => 'value', 'empty' => True),
		array('field' => 'organization', 'type' => 'value', 'empty' => True),
		array('field' => 'number_to', 'type' => 'value', 'empty' => True),
		array('field' => 'content', 'type' => 'value', 'empty' => True),
		array('field' => 'contact_data', 'type' => 'value', 'empty' => True),
		array('field' => 'range.array', 'type' => 'value', 'empty' => True),
		array('field' => 'range_from', 'type' => 'value', 'empty' => True),
		array('field' => 'range_to', 'type' => 'value', 'empty' => True),
		array('field' => 'control', 'type' => 'value', 'empty' => True),
		array('field' => 'close_date', 'type' => 'value', 'empty' => True),
		array('field' => 'cis_template', 'type' => 'value', 'empty' => True),
		array('field' => 'category', 'type' => 'value', 'empty' => True),
		array('field' => 'delivery', 'type' => 'value', 'empty' => True)
	);
	
	
	public function find() {
		$this->Prg->commonProcess();
		$this->paginate['conditions'] = $this->Call->parseCriteria($this->passedArgs);
		$this->set('calls', $this->paginate());
	}
    	
	public function index() {
		$this->Call->recursive = -1;
		$this->set('calls', $this->paginate());
	}

	public function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('Данные о звонке отсутствуют', 'message', array('heading' => 'Ошибка', 'class' => 'alert alert-error span2'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Call->recursive = 2;
		$this->set('call', $this->Call->read(null, $id));
	}
	
	public function history($id = null) {
		$this->Call->id = $id;
		$history = $this->Call->revisions(null, true);
 			if(isset($history) && count($history) == 1) {
			$this->Session->setFlash('Никто не редактировал данные по этому письму', 'message', array('heading' => 'Ошибка', 'class' => 'alert alert-error span4'));
			$this->redirect($this->referer());
		}
		$this->set('histories', $history);
		$this->set('id', $id);
	}
	
/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Call->create();
			$this->request->data['Call']['open_date'] = date('Y-m-d');
			if ($this->Call->saveAll($this->request->data)) {
				$call_id = $this->Call->id;
				if (!empty($this->request->data['CallsDetail'])) {
					$displayname = $this->request->data['CallsDetail'];
					$this->Call->send_email_notification($displayname, null, $call_id, 'new_call');
				}
				if (!empty($this->request->data['Call']['notified'])) {
					$this->Call->send_email_notification($this->request->data['Call']['notified'], null, $call_id, 'notify');	
				}
				$this->Session->setFlash('Данные о звонке сохранены', 'message', array('heading' => 'Успех', 'class' => 'alert alert-success span3'));
				$this->redirect(array('action' => 'index'));
				
			} else {
				$this->Session->setFlash('Сохранение не удалось. Попробуйте ещё раз.', 'message', array('heading' => 'Ошибка', 'class' => 'alert alert-error span3'));
			}
		}
	}

	public function change_state($id = null) {
		$this->Call->id = $id;
		if (!$this->Call->field('close_date')) {
			$this->Call->saveField('close_date', date('Y-m-d'));
		} else {
			$this->Call->saveField('close_date', null);
		}
		$this->redirect($this->referer());
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
 		$this->Call->id = $id;
		if (!$this->Call->exists()) {
			throw new NotFoundException(__('Такого обращения нет'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			//debug($this->request->data);
			if ($this->request->data['SecondStage']['number_of_order'] == '') {
				unset($this->request->data['SecondStage']);
			}
			if ($this->Call->saveAssociated($this->request->data)) {
				if (!empty($this->request->data['Call']['notified'])) {
					$this->Call->send_email_notification($this->request->data['Call']['notified'], null, $id, 'notify');	
				}
				if (!empty($this->data['CallsDetail'])) {
					$this->Call->send_email_notification($this->request->data['CallsDetail'], null, $id, 'edit_call');	
				}
				$this->Session->setFlash('Изменения сохранены', 'message', array('heading' => 'Успех', 'class' => 'alert alert-success span3'));
				$this->redirect(array('action' => 'view', $id));
			} else {
				$this->Session->setFlash('Сохранение не удалось. Попробуйте ещё раз.', 'message', array('heading' => 'Ошибка', 'class' => 'alert alert-error span3'));
			}
		} else {
			$this->data = $this->Call->read(null, $id);
			$close_date = $this->Call->field('close_date');
			$this->set(compact('close_date'));
		}
	}

	public function edit_comment() {
		if ($this->request->is('post') || $this->request->is('put')) {
			if (!empty($this->request->data['CallsDetail']['user_sid_next'])) {
				$count_order = $this->Call->CallsDetail->find('count', array('conditions' => array('call_id' => $this->request->data['CallsDetail']['call_id'])));
				$NewCallsDetail = array('user_sid' => $this->request->data['CallsDetail']['user_sid_next'], 'order' => $count_order + 1, 'call_id' => $this->request->data['CallsDetail']['call_id']);
				$this->Call->CallsDetail->create();
				$this->Call->CallsDetail->save($NewCallsDetail);
				$this->Call->send_email_notification($this->request->data['CallsDetail']['user_sid_next'], $count_order + 1, $this->request->data['CallsDetail']['call_id'], 'call_comment');
			}
			unset($this->request->data['CallsDetail']['user_sid_next']);
			$this->Call->CallsDetail->id = $this->request->data['CallsDetail']['id'];
			$this->request->data['CallsDetail']['date'] = date('Y-m-d G:i:s');
			if ($this->Call->CallsDetail->save($this->request->data)) {
				$this->Session->setFlash('Изменения сохранены', 'message', array('heading' => 'Успех', 'class' => 'alert alert-success span3'));
				$this->redirect(array('action' => 'view',  $this->request->data['CallsDetail']['call_id']));
			} else {
				$this->Session->setFlash('Сохранение не удалось. Попробуйте ещё раз.', 'message', array('heading' => 'Ошибка', 'class' => 'alert alert-error span3'));
			}
		} else {
			$call_id = $this->params['named']['call_id'];
			$calls_detail_id = $this->params['named']['calls_detail_id'];	
			$this->set('call', $this->Call->read(null, $call_id));
			$this->set('calls_detail_id', $calls_detail_id);//Передаём id комментария, чтобы потом сравнить для отображения поля ввода
		}
	}
	
	public function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for call', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Call->delete($id)) {
			$this->Session->setFlash('Обращение было удалено', 'message', array('class' => 'alert alert-success span3'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash('Звонок не был удалён', 'message', array('heading' => 'Ошибка', 'class' => 'alert alert-error span3'));
		$this->redirect(array('action' => 'index'));
	}
}
