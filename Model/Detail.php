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
		    $results[$key]['Detail']['user_sid'] = $this->GetNameFromSid($val['Detail']['user_sid']);
		}
		if (isset($val['Detail']['comment_date'])) {
		    $timestamp = strtotime($results[$key]['Detail']['comment_date']);
		    $results[$key]['Detail']['comment_date'] = date('d.m.Y H:i', $timestamp);
		}
	    }
	    return $results;
	}

	function GetNameFromSid($results) {
	    set_time_limit(0);
	    $base_dn = "CN=Users,DC=aric188,DC=khakassia,DC=ru";
	    if (!($connect = @ldap_connect("ldap://10.188.0.10")))
	        die("Could not connect to ldap server");
	    if (!($bind = @ldap_bind($connect, "*", "*")))
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
	    if (!empty($this->data['Detail']['user_sid'])) {
		    $this->data['Detail']['user_sid'] = $this->GetSidFromName($this->data['Detail']['user_sid']);
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

	function get_email_from_name($displayname) {
		set_time_limit(0);
		$USERNAMETOSEARCH = iconv('utf-8', 'cp1251', $displayname);
		$base_dn = "CN=Users,DC=aric188,DC=khakassia,DC=ru";
		if (!($connect = @ldap_connect("ldap://10.188.0.10")))
			die("Could not connect to ldap server");
		if (!($bind = @ldap_bind($connect, "*", "*")))
			die("Unable to bind to server");
		if ($connect) {
			$filter = "(displayname=" . $USERNAMETOSEARCH . ")";
			$sr = ldap_search($connect, $base_dn, $filter);
			$entries = ldap_get_entries($connect, $sr);
			$email = $entries[0]['mail'][0];
			ldap_close($connect);
		}
	    return $email;
	}
}
