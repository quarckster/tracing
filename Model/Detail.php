<?php
class Detail extends AppModel {
	var $name = 'Detail';
	var $actsAs = array('Containable');
	var $validate = array(
			'user_sid' => array(
        		'rule' => 'notEmpty'
        		),
			'comment' => array(
			'rule' => 'notEmpty'
			)
	    );
	/*var $belongsTo = array(
		'Incident' => array(
			'className' => 'Incident',
			'foreignKey' => 'incident_id'
		)
	);*/
	var $hasMany = array(
		'DetailsRev' => array(
			'className' => 'DetailsRev',
			'foreignKey' => 'id'
		)
	);

	function afterFind($results) {
	    foreach ($results as $key => $val) {
		if ((isset($val['Detail']['user_sid']) && ($val['Detail']['user_sid'] != ''))) {
		    $results[$key]['Detail']['user_sid'] = ClassRegistry::init('User')->GetNameFromSid($val['Detail']['user_sid']);
		}
		if (isset($val['Detail']['comment_date'])) {
		    $timestamp = strtotime($results[$key]['Detail']['comment_date']);
		    $results[$key]['Detail']['comment_date'] = date('d.m.Y H:i', $timestamp);
		}
	    }
	    return $results;
	}

	function beforeSave($options) {
	    if (!empty($this->data['Detail']['user_sid'])) {
		    $this->data['Detail']['user_sid'] = ClassRegistry::init('User')->GetSidFromName($this->data['Detail']['user_sid']);
	    }
	    return true;
	}

	public function beforeDelete() {
		$id = $this->id;
		$details = $this->find('first', array('recursive' => -1, 'conditions' => array('Detail.id' => $id), 'fields' => array('Detail.incident_id', 'Detail.user_sid', 'Detail.comment_id')));
		$this->DetailsRev->set(array('comment_id' => $details['Detail']['comment_id'], 'modify_time' => date('Y-m-d G:i:s'), 'incident_id' => $details['Detail']['incident_id'], 'user_sid' => $details['Detail']['user_sid'], 'changed_by' => AuthComponent::user('displayname')));
		$this->DetailsRev->save();
		return true;
	}
}
