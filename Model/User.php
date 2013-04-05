<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
/**
 * User Model
 *
 */
class User extends AppModel {
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'username' => array(
			'notempty' => array(
				'rule' => array('isUnique'),
				'message' => 'Пользователь с таким именем уже существует',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'password' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Пароль не должен быть пустым',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		)/*,
		'role' => array(
			'valid' => array(
			'rule' => array('inList', array('admin', 'author')),
			'message' => 'Please enter a valid role',
			'allowEmpty' => false
			)
		)*/
	);
	
	public function beforeSave() {
		if (isset($this->data[$this->alias]['password'])) {
			$this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
		}
		if (isset($this->data[$this->alias]['username'])) {
			$this->data[$this->alias]['username'] = strtolower($this->data[$this->alias]['username']);
			$this->data[$this->alias]['user_sid'] = $this->GetSidFromName($this->data[$this->alias]['username']);
			$this->data[$this->alias]['displayname'] = $this->GetDisplayNameFromLogin($this->data[$this->alias]['username']);
		}
		return true;
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
		if (!($bind = @ldap_bind($connect, "ARIC188\addst", "addstaric188")))
		die("Unable to bind to server");
		if ($connect) {
		//$filter = "(sAMAccountName=" . $USERNAMETOSEARCH . ")";
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

	public function GetDisplayNameFromLogin($results) {
		set_time_limit(0);
		$base_dn = "CN=Users,DC=aric188,DC=khakassia,DC=ru";
		if (!($connect = @ldap_connect("ldap://10.188.0.10")))
			die("Could not connect to ldap server");
		if (!($bind = @ldap_bind($connect, "ARIC188\addst", "addstaric188")))
			die("Unable to bind to server");
		if ($connect) {
			$filter = "(sAMAccountName=" . $results . ")";
			$sr = ldap_search($connect, $base_dn, $filter);
			$entries = ldap_get_entries($connect, $sr);
			$results = iconv('cp1251', 'utf-8', $entries[0]['displayname'][0]);
			ldap_close($connect);
		}
			return $results;
	}

	public function GetNameFromSid($results) {
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

	public function GetEmailFromName($displayname) {
		set_time_limit(0);
		$USERNAMETOSEARCH = iconv('utf-8', 'cp1251', $displayname);
		$base_dn = "CN=Users,DC=aric188,DC=khakassia,DC=ru";
		if (!($connect = @ldap_connect("ldap://10.188.0.10")))
			die("Could not connect to ldap server");
		if (!($bind = @ldap_bind($connect, "ARIC188\addst", "addstaric188")))
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
