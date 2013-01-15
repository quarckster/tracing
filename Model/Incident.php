<?php
App::uses('CakeEmail', 'Network/Email');
App::uses('AppModel', 'Model');
/**
 * Incident Model
 *
 * @property User $User
 * @property Detail $Detail
 */
class Incident extends AppModel {

	public $actsAs = array('Containable', 'Search.Searchable', 'Revision' => array('limit' => 10));
	
	public $validate = array(
	            'incoming_num' => array(
        	    'rule' => 'notEmpty'
        	    ),
        	    'content' => array(
        	    'rule' => 'notEmpty'
        	    ),
        	    'organization' => array(
        	    'rule' => 'notEmpty'
        	    ),
        	    'exp_date' => array(
        	    'rule' => 'notEmpty'
        	    ),
        	    'user_sid' => array(
        	    'rule' => 'notEmpty'
        	    )
	    );

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasOne associations
 *
 * @var array
 */
 /*
	public $hasOne = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_sid'
		)
	);
 */
/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Detail' => array(
			'className' => 'Detail',
			'foreignKey' => 'incident_id',
			'dependent' => true,
			'order' => 'Detail.comment_id ASC'
		)
	);
	
	public $filterArgs = array(
		array('name' => 'user_sid', 'type' => 'subquery', 'field' => 'Incident.id', 'method' => 'findByName'),
		array('name' => 'filter', 'type' => 'subquery', 'field' => 'Incident.id', 'method' => 'filter'),
		array('name' => 'range_from', 'name2'=>'range_to', 'type' => 'expression', 'method' => 'makeRangeCondition', 'field' => 'Incident.start_date BETWEEN ? AND ?'), 
		array('name' => 'incoming_num', 'type' => 'value'),
		array('name' => 'number_to', 'type' => 'value'),
		array('name' => 'content', 'type' => 'like'),
		array('name' => 'organization', 'type' => 'like')
	);
	
	public function makeRangeCondition($data, $field = null) {
		if (is_array($data)) {
			if (!empty($field['name'])) {
				return array($data[$field['name']], $data[$field['name2']]);
			} else {
				$input = $data['range'];
			}
		}
	}

	public function findByName($data = array()) {
		$this->Detail->Behaviors->attach('Search.Searchable');
		$user_sid = $this->GetSidFromName($data['user_sid']);
		if ($data['filter'] == 'in_progress') {
			$query = $this->Detail->getQuery('all', array(
				'conditions' => array('Detail.user_sid'  => $user_sid, 'Detail.comment' => ''),
				'fields' => array('incident_id')
			));
		} else {
			$query = $this->Detail->getQuery('all', array(
				'conditions' => array('Detail.user_sid'  => $user_sid),
				'fields' => array('incident_id')
			));
		}
		$query = str_replace(", `Detail`.`id`", "", $query); //В старой версии пирога такого делать не нужно было. Полный отстой, но лучшего я не придумал
		return $query;
	}
	
	public function beforeSave($options) {
		//if (!empty($this->data['Incident']['user_sid'])) {
		//	$this->data['Incident']['user_sid'] = $this->GetSidFromName($this->data['Incident']['user_sid']);
		//}
		if (!empty($this->data['Incident']['exp_date'])) {
			$this->data['Incident']['exp_date'] = date('Y-m-d', strtotime($this->data['Incident']['exp_date']));
		}
		if (!empty($this->data['Incident']['start_date'])) {
			$this->data['Incident']['start_date'] = date('Y-m-d', strtotime($this->data['Incident']['start_date']));
		}
		return true;
	}
	
	public function afterFind($results) {
	    foreach ($results as $key => $val) {
		if (isset($val['Incident']['start_date'])) {
		    $timestamp = strtotime($results[$key]['Incident']['start_date']);
		    $results[$key]['Incident']['start_date'] = date('d.m.Y', $timestamp);
		}
		if (isset($val['Incident']['exp_date'])) {
		    $timestamp = strtotime($results[$key]['Incident']['exp_date']);
		    $results[$key]['Incident']['exp_date'] = date('d.m.Y', $timestamp);
		}
		//if (isset($val['Incident']['user_sid'])) {
		//    $results[$key]['Incident']['user_sid'] = $this->User->field('username', $val['Incident']['user_sid']);
		//}
	    }
	    return $results;
	}
	
	public function findLastIncomingNum() {
		$incoming_number['IP'] = $this->find('first', array('order' => array('Incident.id DESC'), 'recursive' => -1, 'fields' => array('Incident.incoming_num'), 'conditions' => array('Incident.incoming_num LIKE' => '%ИП%')));
		$incoming_number['API'] = $this->find('first', array('order' => array('Incident.id DESC'), 'recursive' => -1, 'fields' => array('Incident.incoming_num'), 'conditions' => array('Incident.incoming_num LIKE' => '%АПИ%')));
		$incoming_number['KS'] = $this->find('first', array('order' => array('Incident.id DESC'), 'recursive' => -1, 'fields' => array('Incident.incoming_num'), 'conditions' => array('Incident.incoming_num REGEXP' => '^[0-9]+КС-[0-9]+$')));
		$incoming_number['RKS'] = $this->find('first', array('order' => array('Incident.id DESC'), 'recursive' => -1, 'fields' => array('Incident.incoming_num'), 'conditions' => array('Incident.incoming_num LIKE' => '%РКС%')));
		$incoming_number['SP'] = $this->find('first', array('order' => array('Incident.id DESC'), 'recursive' => -1, 'fields' => array('Incident.incoming_num'), 'conditions' => array('Incident.incoming_num LIKE' => '%СП%')));
		$incoming_numbers = array($incoming_number['IP']['Incident']['incoming_num'], $incoming_number['API']['Incident']['incoming_num'], $incoming_number['KS']['Incident']['incoming_num'], $incoming_number['RKS']['Incident']['incoming_num'], $incoming_number['SP']['Incident']['incoming_num']);
		return $incoming_numbers;
	}

	public function user_filter($user_sid) {
		$user_sid = $this->GetSidFromName($user_sid);
		$this->query('CREATE TEMPORARY TABLE temp_details1 (id int(11) NOT NULL AUTO_INCREMENT, detail_id int(11) NOT NULL, PRIMARY KEY(id));');
		$this->query('INSERT INTO temp_details1 (detail_id) SELECT id-1 AS id FROM details WHERE user_sid ="'.$user_sid.'" AND comment_date IS NULL AND comment = "" AND notify_only = 0;');
		$this->query('CREATE TEMPORARY TABLE temp_details (id int(11) NOT NULL AUTO_INCREMENT, incident_id int(11) NOT NULL, PRIMARY KEY(id));');
		$this->query('INSERT INTO temp_details (incident_id) SELECT incident_id FROM temp_details1 AS TempDetail1 INNER JOIN details AS Detail ON (Detail.id = TempDetail1.detail_id AND Detail.comment_date IS NOT NULL AND Detail.comment != "");');
		$joins1 = array(
				   array('table' => 'temp_details',
					     'alias' => 'TempDetail',
					     'type' => 'INNER',
					     'conditions' => array('Incident.id = TempDetail.incident_id')
				   )
		);
		$result1 = $this->find('all', array('recursive' => 1, 'joins' => $joins1));
		$result1 = Set::remove($result1, 'TempDetail');
		$joins2 = array(
					array('table' => 'details',
					'alias' => 'Detail',
					'type' => 'INNER',
					'conditions' => array(
						'Detail.incident_id = Incident.id', 'Detail.comment_id = 1', 'Detail.notify_only != 1', 'Detail.comment_date IS NULL', 'Detail.user_sid ="'.$user_sid.'"')
					)
				);
		$result2 = $this->find('all', array('recursive' => 1, 'joins' => $joins2));
		if (empty($result1)){
			$result = $result2;
		} elseif (empty($result2)){
			$result = $result1;
		} else {
			$result = Set::merge($result1, $result2);
		}
		$result = Set::sort($result, '{n}.Incident.id', 'desc');
		return $result;
	}

	public function filter($data = array()) {
		if($data['filter'] == 'in_progress') {
			$this->query('CREATE TEMPORARY TABLE temp_details (id int(11) NOT NULL AUTO_INCREMENT, comment_id int(1) NOT NULL, incident_id int(11) NOT NULL, PRIMARY KEY(id));');
			$this->query('INSERT INTO temp_details (comment_id, incident_id) SELECT MAX(Detail.comment_id), Detail.incident_id FROM details Detail WHERE Detail.notify_only != 1 GROUP BY Detail.incident_id;');
			$b = array(
				array('table' => 'details',
				'alias' => 'Detail',
				'type'	=> 'INNER',
				'conditions' => array('Detail.incident_id = TempDetail.incident_id', 'Detail.comment_id = TempDetail.comment_id')
				),
				array('table' => 'incidents',
				'alias' => 'Incident',
				'type' => 'INNER',
				'conditions' => array('TempDetail.incident_id = Incident.id', 'Detail.comment_date IS NULL', 'Incident.exp_date >= CURDATE()')
			    	)
			);
			$query = ClassRegistry::init('TempDetail')->getQuery('all', array('joins' => $b, 'fields' => array('Incident.id')));
		}
		if($data['filter'] == 'delayed') {
			$this->query('CREATE TEMPORARY TABLE temp_details (id int(11) NOT NULL AUTO_INCREMENT, comment_id int(1) NOT NULL, incident_id int(11) NOT NULL, PRIMARY KEY(id));');
			$this->query('INSERT INTO temp_details (comment_id, incident_id) SELECT MAX(Detail.comment_id), Detail.incident_id FROM details Detail WHERE Detail.notify_only != 1 GROUP BY Detail.incident_id;');
			$b = array(
				array('table' => 'details',
				'alias' => 'Detail',
				'type'	=> 'INNER',
				'conditions' => array('Detail.incident_id = TempDetail.incident_id', 'Detail.comment_id = TempDetail.comment_id')
				),
				array('table' => 'incidents',
				'alias' => 'Incident',
				'type' => 'INNER',
				'conditions' => array('Incident.exp_date < CURDATE()', 'Incident.exp_date < DATE_FORMAT(Detail.comment_date, \'%Y-%m-%d\')', 'TempDetail.incident_id = Incident.id')
			    	)
			);
			$query = ClassRegistry::init('TempDetail')->getQuery('all', array('joins' => $b, 'fields' => array('Incident.id')));
		}
		if($data['filter'] == 'delayed_in_progress') {
			$this->query('CREATE TEMPORARY TABLE temp_details (id int(11) NOT NULL AUTO_INCREMENT, comment_id int(1) NOT NULL, incident_id int(11) NOT NULL, PRIMARY KEY(id));');
			$this->query('INSERT INTO temp_details (comment_id, incident_id) SELECT MAX(Detail.comment_id), Detail.incident_id FROM details Detail WHERE Detail.notify_only != 1 GROUP BY Detail.incident_id;');
			$b = array(
				array('table' => 'details',
				'alias' => 'Detail',
				'type'	=> 'INNER',
				'conditions' => array('Detail.incident_id = TempDetail.incident_id', 'Detail.comment_id = TempDetail.comment_id')
				),
				array('table' => 'incidents',
				'alias' => 'Incident',
				'type' => 'INNER',
				'conditions' => array('TempDetail.incident_id = Incident.id', 'Detail.comment_date IS NULL', 'Incident.exp_date < CURDATE()', 'Incident.incoming_num != -1')
			    	)
			);
			$query = ClassRegistry::init('TempDetail')->getQuery('all', array('joins' => $b, 'fields' => array('Incident.id')));
		}
		if($data['filter'] == 'archive') {
			$this->query('CREATE TEMPORARY TABLE temp_details (id int(11) NOT NULL AUTO_INCREMENT, comment_id int(1) NOT NULL, incident_id int(11) NOT NULL, PRIMARY KEY(id));');
			$this->query('INSERT INTO temp_details (comment_id, incident_id) SELECT MAX(Detail.comment_id), Detail.incident_id FROM details Detail WHERE Detail.notify_only != 1 GROUP BY Detail.incident_id;');
			$b = array(
				array('table' => 'details',
				'alias' => 'Detail',
				'type'	=> 'INNER',
				'conditions' => array('Detail.incident_id = TempDetail.incident_id', 'Detail.comment_id = TempDetail.comment_id')
				),
				array('table' => 'incidents',
				'alias' => 'Incident',
				'type' => 'INNER',
				'conditions' => array('TempDetail.incident_id = Incident.id', 'Incident.exp_date >= DATE_FORMAT(Detail.comment_date, \'%Y-%m-%d\')', 'Detail.comment_date IS NOT NULL')
			    	)
			);
			$query = ClassRegistry::init('TempDetail')->getQuery('all', array('joins' => $b, 'fields' => array('Incident.id')));
		}
		if($data['filter'] == 'debt') {
			//$this->Incident->recursive = '-1';
			$query = $this->getQuery('all', array('fields' => array('Incident.id'), 'conditions' => array('Incident.incoming_num' => '-1')));
		}
		return $query;
	}

	public function send_email_notification($displayname, $detail_id, $incident_id, $type) {
		$incident = $this->read(null, $incident_id);
		$email = new CakeEmail();
		$email->config('default');
		$email->viewVars(array('incident' => $incident));
		if (($type == 'new_mail') && ($displayname['2']['notify_only'] == 0)) { //отправляем извещение о создании нового письма всем участникам маршрута кроме первого и тех кто не комментирует письмо
			$recipient = array();
			for ($i = 2; $i <= count($displayname); $i++):
				if ($displayname[$i]['notify_only'] == 0) {
					$recipient[] = $this->Detail->get_email_from_name($displayname[$i]['user_sid']);
				}
			endfor;
			$subj = "Новое входящее. Номер ТО {$incident['Incident']['number_to']}. {$incident['Incident']['content']}";
			$email->subject($subj)
				->to($recipient)
				->template('new_mail')
				->send();
		}
		if (($type == 'new_mail') && ($displayname['1']['notify_only'] == 0)) { //отправляем уведомление первому участнику маршрута о том, что необходимо оставить комментарий. Первый участник не должен быть в списке тех, кто не комментирует
			unset($recipient);
			$recipient = $this->Detail->get_email_from_name($displayname['1']['user_sid']);
			$subj = "Оставьте свой коммен­тарий. Номер ТО {$incident['Incident']['number_to']}. {$incident['Incident']['content']}";
			$email->subject($subj)
				->viewVars(array('detail_id' => $this->Detail->field('id', array('incident_id' => $incident_id, 'comment_id' => '1'))))
				->to($recipient)
				->template('new_comment')
				->send();
		}
		if ($type == 'new_mail') { //отправляем извещение о создании нового письма участникам маршрута, которые не должны оставлять комментарии
			unset($recipient);
			$recipient = array();
			for ($i = 1; $i <= count($displayname); $i++):
				if ($displayname[$i]['notify_only'] == 1) {
					$recipient[] = $this->Detail->get_email_from_name($displayname[$i]['user_sid']);
				}
			endfor;
			if (!empty($recipient)) {
				$subj = "Новое входящее. Номер ТО {$incident['Incident']['number_to']}. {$incident['Incident']['content']}";
				$email->subject($subj)
					->to($recipient)
					->template('new_mail')
					->send();
			}
		}
		if ($type == 'new_comment') {
			$recipient = $this->Detail->get_email_from_name($displayname);
			$subj = "Оставьте свой коммен­тарий. Номер ТО {$incident['Incident']['number_to']}";
			$email->subject($subj)
				->viewVars(array('detail_id' => $detail_id))
				->to($recipient)
				->template('new_comment')
				->send();
		}
		if ($type == 'edit_incident') {
			$recipient = $this->Detail->get_email_from_name($displayname);
			$subj = "Входящее письмо было отредактировано. Номер ТО {$incident['Incident']['number_to']}";
			$email->subject($subj)
				->viewVars(array('detail_id' => $detail_id))
				->to($recipient)
				->template('edit_incident')
				->send();
		}
	}

	public function GetSidFromName($displayname) {
	    set_time_limit(0);
	    $USERNAMETOSEARCH = iconv('utf-8', 'cp1251', $displayname);

	// Set the base dn to search the entire directory.
	    $base_dn = "CN=Users,DC=aric188,DC=khakassia,DC=ru";
	// connect to server
	    if (!($connect = @ldap_connect("ldap://10.188.0.10")))
		die("Could not connect to ldap server");
	// bind to server
	    if (!($bind = @ldap_bind($connect, "*", "*")))
		die("Unable to bind to server");
	    if ($connect) {
		$filter = "(displayname=" . $USERNAMETOSEARCH . ")";
		$sr = ldap_search($connect, $base_dn, $filter);
		$entries = ldap_get_entries($connect, $sr);

	// All SID's begin with S-
		$sid = "S-";
	// Convert Bin to Hex and split into byte chunks
		$sidinhex = str_split(bin2hex($entries[0]['objectsid'][0]), 2);
	// Byte 0 = Revision Level
		$sid = $sid . hexdec($sidinhex[0]) . "-";
	// Byte 1-7 = 48 Bit Authority
		$sid = $sid . hexdec($sidinhex[6] . $sidinhex[5] . $sidinhex[4] . $sidinhex[3] . $sidinhex[2] . $sidinhex[1]);
	// Byte 8 count of sub authorities - Get number of sub-authorities
		$subauths = hexdec($sidinhex[7]);
	// Loop through Sub Authorities
		for ($i = 0; $i < $subauths; $i++) {
		    $start = 8 + (4 * $i);
		    // X amount of 32Bit (4 Byte) Sub Authorities
		    $sid = $sid . "-" . hexdec($sidinhex[$start + 3] . $sidinhex[$start + 2] . $sidinhex[$start + 1] . $sidinhex[$start]);
		}
		ldap_close($connect);
	    }
	    return $sid;
	}
	public function getStatsData($start, $end) {
		$stats = $this->find('count', array('conditions' => array('Incident.start_date BETWEEN ? and ?' => array($start, $end)), 'recursive' => -1));
		return $stats;
	}
}
