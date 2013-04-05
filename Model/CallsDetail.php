<?php
App::uses('AppModel', 'Model');
class CallsDetail extends AppModel {
	public $name = 'CallsDetail';
	//var $actsAs = array('Containable');
	public $validate = array(
			'user_sid' => array(
        		'rule' => 'notEmpty'
        		),
			'comment' => array(
			'rule' => 'notEmpty'
			)
	);
	public $belongsTo = array(
		'Call' => array(
			'className' => 'Call',
			'foreignKey' => 'call_id'
		)
	);
	public function afterFind($results) {
	    foreach ($results as $key => $val) {
		if ((isset($val['CallsDetail']['user_sid']) && ($val['CallsDetail']['user_sid'] != ''))) {
		    $results[$key]['CallsDetail']['user_sid'] = ClassRegistry::init('User')->GetNameFromSid($val['CallsDetail']['user_sid']);
		}
		if (isset($val['CallsDetail']['date'])) {
		    $timestamp = strtotime($results[$key]['CallsDetail']['date']);
		    $results[$key]['CallsDetail']['date'] = date('d.m.Y G:i', $timestamp);
		}
	    }
	    return $results;
	}

	public function beforeSave($options) {
	    if (!empty($this->data['CallsDetail']['user_sid'])) {
		    $this->data['CallsDetail']['user_sid'] = ClassRegistry::init('User')->GetSidFromName($this->data['CallsDetail']['user_sid']);
	    }
	    return true;
	}
}
?>
