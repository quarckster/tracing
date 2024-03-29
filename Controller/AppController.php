<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');

/**
 * This is a placeholder class.
 * Create the same file in app/Controller/AppController.php
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       Cake.Controller
 * @link http://book.cakephp.org/view/957/The-App-Controller
 */
class AppController extends Controller {

	public $theme = 'Bootstrap2';
	public $layout = 'generic';
	//public $helpers = array('Js' => array('Jquery');
	public $helpers = array('Html','Form','Session','Js' => array('Jquery'),'Paginator');
	public $components = array(
		'Session',
		'Auth' => array(
			'loginRedirect' => array('controller' => 'pages', 'action' => 'index'),
			'logoutRedirect' => array('controller' => 'users', 'action' => 'login'),
				'authorize' => array('Controller'),
				'authError' => 'У вас нет доступа к этому разделу.'
		)
	);

	public function isAuthorized($user) {
		if (isset($user['role']) && $user['role'] === 'admin') {
			return true; //Admin can access every action
		}
		$this->Session->setFlash('У вас нет доступа к этому разделу', 'message', array('heading' => 'Предупреждение', 'class' => 'alert alert-warning span3'));
		return false; // The rest don't
	}

	public function beforeFilter() {
		$this->Auth->allow('user_filter', 'history', 'index', 'find', 'display', 'view', 'edit_comment', 'change_state', 'add');
		if ($this->Auth->user('id') == 1) {
			Configure::write('debug', 2);
			$this->components[] = 'DebugKit.Toolbar';
		}
	}

}

