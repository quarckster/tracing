<?php
class Call extends AppModel {
	var $name = 'Call';
	var $actsAs = array('Containable', 'Search.Searchable', 'Revision' => array('limit' => 10));
	var $validate = array(
		'user_sid' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'organization' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'content' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'contact_data' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		)
	);
	public $hasOne = 'SecondStage';
	
	var $hasMany = array(
		'CallsDetail' => array(
			'className' => 'CallsDetail',
			'foreignKey' => 'call_id',
			'order' =>  'CallsDetail.order ASC',			
			'dependent' => true
		)
	);

	var $filterArgs = array(
		array('name' => 'user_sid', 'type' => 'expression', 'field' => 'Call.user_sid', 'method' => 'findByName'),
		array('name' => 'range_from', 'name2'=>'range_to', 'type' => 'expression', 'method' => 'makeRangeCondition', 'field' => 'Call.open_date BETWEEN ? AND ?'), 
		array('name' => 'category', 'type' => 'value'),
		array('name' => 'close_date', 'type' => 'expression', 'field' => 'close_date', 'method' => 'filterDate'),
		array('name' => 'filter', 'type' => 'query', 'method' => 'filterExpired'),
		array('name' => 'delivery', 'type' => 'value'),
		array('name' => 'control', 'type' => 'value'),
		array('name' => 'cis_template', 'type' => 'value'),		
		array('name' => 'organization', 'type' => 'like'),
		array('name' => 'number_to', 'type' => 'value'),
		array('name' => 'contact_data', 'type' => 'like'),
		array('name' => 'content', 'type' => 'like')
	);

	public function filterExpired($data = array()) {
		if ($data['filter'] == 'expired') {
			$this->recursive = -1;
			$query = '(TO_DAYS(Call.close_date) - TO_DAYS(Call.open_date) > 1) AND NOT (WeekDay(Call.open_date) = 4 AND (TO_DAYS(Call.close_date) - TO_DAYS(Call.open_date) = 3))';
		}
		return $query;		
	}

	public function filterDate($data = array()) {
		$this->recursive = -1;
		if ($data['close_date'] == 1) {
			$query = null;
		}
		return $query;
	}

	public function makeRangeCondition($data, $field = null) {
		if (is_array($data)) {
			if (!empty($field['name'])) {
				return array($data[$field['name']], $data[$field['name2']]);
			} else {
				$input = $data['range'];
			}
		}
	}
	
	function findByName($data = array()) {
		$user_sid = $this->GetSidFromName($data['user_sid']);
		return $user_sid;
	}

	function afterFind($results) {
		foreach ($results as $key => $val) {
			if ((isset($val['Call']['user_sid']) && ($val['Call']['user_sid'] != ''))) {
				$results[$key]['Call']['user_sid'] = $this->GetNameFromSid($val['Call']['user_sid']);
			}
			if (isset($val['Call']['open_date'])) {
				$timestamp = strtotime($results[$key]['Call']['open_date']);
				$results[$key]['Call']['open_date'] = date('d.m.Y', $timestamp);
			}
			if (isset($val['Call']['close_date'])) {
				$timestamp = strtotime($results[$key]['Call']['close_date']);
				$results[$key]['Call']['close_date'] = date('d.m.Y', $timestamp);
			}
		}
		return $results;
	}

	function GetNameFromSid($results) {
		set_time_limit(0);
		$base_dn = "CN=Users,DC=aric188,DC=khakassia,DC=ru";
		if (!($connect = @ldap_connect("ldap://10.188.0.10")))
			die("Could not connect to ldap server");
		if (!($bind = @ldap_bind($connect, "ARIC188\addst", "addstaric188")))
			die("Unable to bind to server");
		if ($connect) {
			$filter = "(objectSid=" . $results . ")";
			$sr = ldap_search($connect, $base_dn, $filter);
			$entries = ldap_get_entries($connect, $sr);
			$results = iconv('cp1251', 'utf-8', $entries[0]['displayname'][0]);
			ldap_close($connect);
		}
	    	return $results;
	}

	function beforeSave($options) {
		if (!empty($this->data['Call']['user_sid'])) {
			$this->data['Call']['user_sid'] = $this->GetSidFromName($this->data['Call']['user_sid']);
		}
		if (!empty($this->data['Call']['notified']) && !empty($this->data['Call']['id'])) {
			$notified_in_base = $this->field('notified', array('id' => $this->data['Call']['id']));
			$notified_in_data = $this->data['Call']['notified'];
				if (empty($notified_in_base)) {
					$notified_summary = $notified_in_data;
				} else {
					$notified_summary = $notified_in_base . ', ' . $notified_in_data;
				}
			$this->data['Call']['notified'] = $notified_summary;
		}
		if (empty($this->data['Call']['notified'])) {
			unset($this->data['Call']['notified']);
		}
		if (empty($this->data['Call']['number_to'])) {
			unset($this->data['Call']['number_to']);
		}
		return true;
	}

	function GetSidFromName($displayname) {
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

	public function send_email_notification($displayname, $order, $call_id, $type) {
		$call = $this->read(null, $call_id);
		$email = new CakeEmail();
		$email->config('default');
		$email->viewVars(array('call' => $call));
		if ($type == 'new_call') {
			$recipient = array();
			for ($i = 1; $i <= count($displayname); $i++){
				$recipient[] = $this->CallsDetail->get_email_from_name($displayname[$i]['user_sid']);
			}
			$subj = 'Оставьте свой комментарий';
			$email->subject($subj)
				->to($recipient)
				->template('new_call')
				->send();		
		}
		if ($type == 'edit_call') { //Отправляем письма людям, которые были добавлены после редактирования обращения
			$recipient = array();
			for ($i = 0; $i <= count($displayname) - 1; $i++){
				if (!isset($displayname[$i]['id'])) { // Исключаем людей, которые уже были в участниках обращения
					$recipient[] = $this->CallsDetail->get_email_from_name($displayname[$i]['user_sid']);
				}
			}
			$subj = 'Оставьте свой комментарий';
			$email->subject($subj)
				->to($recipient)
				->template('new_call')
				->send();
		}
		if ($type == 'call_comment') {
			unset($recipient);
			$recipient = $this->CallsDetail->get_email_from_name($displayname);
			$subj = 'Оставьте свой комментарий по ссылке';
			$calls_detail_id = $this->set('calls_detail_id', $this->CallsDetail->field('id', array('call_id' => $call_id, 'order' => $order)));
			$email->subject($subj)
				->to($recipient)
				->template('call_comment')
				->viewVars(array('calls_detail_id' => $calls_detail_id))
				->send();
		}
		if ($type == 'notify') {
			$exploded_displayname = explode(', ', $displayname);
			unset($recipient);
			$recipient = array();
			foreach ($exploded_displayname as $name){
				$recipient[] = $this->CallsDetail->get_email_from_name($name);
			}
			$subj = 'Уведомление об обращении клиента';
			$email->subject($subj)
				->to($recipient)
				->template('new_call')
				->send();
		}
	}

	public function getStatsData($start, $end) {
		$stats['Сбой']['overall'] = $this->find('count', array('conditions' => array('Call.open_date BETWEEN ? and ?' => array($start, $end), 'category' => 'Сбой'), 'recursive' => -1));
		$stats['Демо']['overall'] = $this->find('count', array('conditions' => array('Call.open_date BETWEEN ? and ?' => array($start, $end), 'category' => 'Демо'), 'recursive' => -1));
		$stats['Инф.']['overall'] = $this->find('count', array('conditions' => array('Call.open_date BETWEEN ? and ?' => array($start, $end), 'category' => 'Инф.'), 'recursive' => -1));
		$stats['ЗД']['overall'] = $this->find('count', array('conditions' => array('Call.open_date BETWEEN ? and ?' => array($start, $end), 'category' => 'ЗД'), 'recursive' => -1));
		$stats['КФВ']['overall'] = $this->find('count', array('conditions' => array('Call.open_date BETWEEN ? and ?' => array($start, $end), 'category' => 'КФВ'), 'recursive' => -1));
		$stats['ЗД']['Звонок'] = $this->find('count', array('conditions' => array('Call.open_date BETWEEN ? and ?' => array($start, $end), 'category' => 'ЗД', 'delivery' => 'Звонок'), 'recursive' => -1));
		$stats['ЗД']['Сайт'] = $this->find('count', array('conditions' => array('Call.open_date BETWEEN ? and ?' => array($start, $end), 'category' => 'ЗД', 'delivery' => 'Сайт'), 'recursive' => -1));
		$stats['ЗД']['СИО'] = $this->find('count', array('conditions' => array('Call.open_date BETWEEN ? and ?' => array($start, $end), 'category' => 'ЗД', 'delivery' => 'СИО'), 'recursive' => -1));
		$stats['ЗД']['Визит'] = $this->find('count', array('conditions' => array('Call.open_date BETWEEN ? and ?' => array($start, $end), 'category' => 'ЗД', 'delivery' => 'Визит'), 'recursive' => -1));
		$stats['ЗД']['Email'] = $this->find('count', array('conditions' => array('Call.open_date BETWEEN ? and ?' => array($start, $end), 'category' => 'ЗД', 'delivery' => 'Email'), 'recursive' => -1));
		$stats['Демо']['Звонок'] = $this->find('count', array('conditions' => array('Call.open_date BETWEEN ? and ?' => array($start, $end), 'category' => 'Демо', 'delivery' => 'Звонок'), 'recursive' => -1));
		$stats['Демо']['Сайт'] = $this->find('count', array('conditions' => array('Call.open_date BETWEEN ? and ?' => array($start, $end), 'category' => 'Демо', 'delivery' => 'Сайт'), 'recursive' => -1));
		$stats['Демо']['СИО'] = $this->find('count', array('conditions' => array('Call.open_date BETWEEN ? and ?' => array($start, $end), 'category' => 'Демо', 'delivery' => 'СИО'), 'recursive' => -1));
		$stats['Демо']['Визит'] = $this->find('count', array('conditions' => array('Call.open_date BETWEEN ? and ?' => array($start, $end), 'category' => 'Демо', 'delivery' => 'Визит'), 'recursive' => -1));
		$stats['Демо']['Email'] = $this->find('count', array('conditions' => array('Call.open_date BETWEEN ? and ?' => array($start, $end), 'category' => 'Демо', 'delivery' => 'Email'), 'recursive' => -1));
		$stats['КФВ']['Звонок'] = $this->find('count', array('conditions' => array('Call.open_date BETWEEN ? and ?' => array($start, $end), 'category' => 'КФВ', 'delivery' => 'Звонок'), 'recursive' => -1));
		$stats['КФВ']['Сайт'] = $this->find('count', array('conditions' => array('Call.open_date BETWEEN ? and ?' => array($start, $end), 'category' => 'КФВ', 'delivery' => 'Сайт'), 'recursive' => -1));
		$stats['КФВ']['СИО'] = $this->find('count', array('conditions' => array('Call.open_date BETWEEN ? and ?' => array($start, $end), 'category' => 'КФВ', 'delivery' => 'СИО'), 'recursive' => -1));
		$stats['КФВ']['Визит'] = $this->find('count', array('conditions' => array('Call.open_date BETWEEN ? and ?' => array($start, $end), 'category' => 'КФВ', 'delivery' => 'Визит'), 'recursive' => -1));
		$stats['КФВ']['Email'] = $this->find('count', array('conditions' => array('Call.open_date BETWEEN ? and ?' => array($start, $end), 'category' => 'КФВ', 'delivery' => 'Email'), 'recursive' => -1));
		return $stats;
	}
}
?>
