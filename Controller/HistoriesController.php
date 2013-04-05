<?php
App::uses('AppController', 'Controller');
App::uses('AuthComponent', 'Controller/Component');
class HistoriesController extends AppController {

	var $name = 'Histories';
	var $layout = 'incidents';
	
	/*public function index() {
		$this->Incident->recursive = -1;
		$this->set('incidents', $this->paginate());
	}*/
	
	public function incidentList() {
		$Incident = ClassRegistry::init('Incident');
		$this->Incident->id = $this->request->params['named']['incident_id'];
		$diff = $this->Incident->diff();
		debug($diff);
		$history = $this->Incident->revisions();
		$this->set('histories', $history);
		if(isset($history) && count($history) == 0) {
			$this->Session->setFlash(__('Никто не редактировал это письмо', true));
			$this->redirect($this->referer());
		}
	}
	
	public function incident_view() {
		$Incident = ClassRegistry::init('Incident');
		$Incident->id = $this->request->params['named']['incident_id'];
		$version_id = $this->params['named']['version_id'];
		$history = $Incident->revisions(array('conditions' => array('version_id' => $version_id)));
		$this->set('history', $history['0']);
	}
}
?>
