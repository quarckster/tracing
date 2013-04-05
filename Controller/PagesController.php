<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController {
	public $layout = 'generic';
/**
 * Default helper
 *
 * @var array
 */
	public $helpers = array('Html');

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array('Call', 'Incident', 'Outgoing', 'SecondStage');

/**
 * Displays a view
 *
 * @param mixed What page to display
 */
	public function display() {
		$path = func_get_args();

		$count = count($path);
		if (!$count) {
			$this->redirect('/');
		}
		$page = $subpage = $title = null;

		if (!empty($path[0])) {
			$page = $path[0];
		}
		if (!empty($path[1])) {
			$subpage = $path[1];
		}
		if (!empty($path[$count - 1])) {
			$title = Inflector::humanize($path[$count - 1]);
		}
		$this->set(compact('page', 'subpage'));
		$this->set('title_for_layout', $title);
		if (method_exists($this, $page)) {
    			$this->$page();
		} 		
		$this->render(implode('/', $path));
	}
	
	public function stats() {
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->request->data['Stats']['start'] <= $this->request->data['Stats']['end']) {
				$stats_data['Calls'] = $this->Call->getStatsData($this->request->data['Stats']['start'], $this->request->data['Stats']['end']);
				$stats_data['Incidents'] = $this->Incident->getStatsData($this->request->data['Stats']['start'], $this->request->data['Stats']['end']);
				$stats_data['Outgoings'] = $this->Outgoing->getStatsData($this->request->data['Stats']['start'], $this->request->data['Stats']['end']);
				$stats_data['SecondStages'] = $this->SecondStage->getStatsData($this->request->data['Stats']['start'], $this->request->data['Stats']['end']);
				$this->set('stats_data', $stats_data);
			} else {
				$this->Session->setFlash(__('Начальная дата не может быть позже конечной', true));
				$this->redirect($this->referer());
			}
		}
	}

}
