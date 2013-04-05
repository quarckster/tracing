<?php
App::uses('CakeEmail', 'Network/Email');
App::uses('AppModel', 'Model');
/**
 * TrainingsComment Model
 *
 */
class TrainingsComment extends AppModel {

	public $validate = array(
			'user_sid' => array(
			'rule' => 'notEmpty'
			),
			'comment' => array(
			'rule' => 'notEmpty'
			)
	);

	public $belongsTo = 'Training';

	public function afterFind($results) {
		 foreach ($results as $key => $val) {
			if (isset($val['TrainingsComment']['date'])) {
				$timestamp = strtotime($results[$key]['TrainingsComment']['date']);
				$results[$key]['TrainingsComment']['date'] = date('d.m.Y H:i', $timestamp);
			}
			return $results;
		}		
	}

	public function beforeSave($options) {
			$this->data['TrainingsComment']['date'] = date('Y-m-d H:i:s', time());
		return true;
	}

	public function SendEmailNotification($data) {
		$this->Training->recursive = -1;
		//$training = $this->Training->find('first', array('recursive' => -1, 'conditions' => array('id' => $trainings_id)));
		$training = $this->Training->findById($data['TrainingsComment']['trainings_id']);
		// $recipient = ClassRegistry::init('User')->GetEmailFromName($training['Training']['user_sid']);
		//debug($training);
		$email = new CakeEmail();
		//$email->config('default');
		//$email->viewVars(array('comment' => $comment, 'training' => $training));
		$subj = "Коммен­тарий к заявке на обучение № {$training['Training']['training_num']}";
		$email->subject($subj)
			->viewVars(array('data' => $data, 'training' => $training))
			->config('default')
			->to(ClassRegistry::init('User')->GetEmailFromName($training['Training']['user_sid']))
			->template('training_comment')
			->send();
	}
}
