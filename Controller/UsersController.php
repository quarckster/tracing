<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends AppController {
	public $layout = 'generic';

	/*public function isAuthorized($user) {
		if ($this->action === 'logout') {
			return true;
		}
		return parent::isAuthorized($user);
	}*/


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->set('user', $this->User->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->request->data['User']['role'] = 'author';
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$id = $this->User->id;
				$this->request->data['User'] = array_merge($this->request->data['User'], array('id' => $id));
				$this->Auth->login($this->request->data['User']); // Логиним пользователя после регистрации
				$this->Session->setFlash('Регистрация прошла успешно', 'message', array('class' => 'alert alert-success span2'));
				$this->redirect('/');
			} else {
				$this->Session->setFlash('Регистрация не удалась. Попробуйте ещё раз', 'message', array('heading' => 'Ошибка', 'class' => 'alert alert-error span2'));
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
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->User->read(null, $id);
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
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->User->delete()) {
			$this->Session->setFlash(__('User deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('User was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

	public function beforeFilter() {
		parent::beforeFilter();
		if ($this->Auth->loggedIn()) {
			$this->Session->setFlash('Вы уже зарегистрированы', 'message', array('heading' => 'Предупреждение', 'class' => 'alert alert-warning span3'));
			$this->Auth->deny('add');
			$this->Auth->allow('logout');
		} else {
			$this->Auth->allow('add');
		}
	}

	public function login() {
		if ($this->request->is('post')) {
			$this->request->data['User']['username'] = strtolower($this->request->data['User']['username']);
		}
		if ($this->Auth->login()) {
			$this->Session->setFlash('Вход произведён успешно', 'message', array('heading' => 'Сообщение', 'class' => 'alert alert-success span4'));
			$this->redirect($this->Auth->redirect());
		}
		if (!$this->Auth->login() && !empty($this->request->data)) {
			$this->Session->setFlash('Неверный логин или пароль, попробуйте ещё раз', 'message', array('heading' => 'Ошибка', 'class' => 'alert alert-error span4'));
		}
	}

	public function logout() {
		$this->Session->setFlash('Выход произведён успешно', 'message', array('heading' => 'Сообщение', 'class' => 'alert alert-success span4'));
		$this->redirect($this->Auth->logout());
	}
}
