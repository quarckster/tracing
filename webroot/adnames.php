<?php

$return_arr = array();

set_time_limit(0);

// Set the base dn to search the entire directory.
$base_dn = "CN=Users,DC=aric188,DC=khakassia,DC=ru";
// connect to server
if (!($connect = @ldap_connect("ldap://10.188.0.10")))
    die("Could not connect to ldap server");
// bind to server
if (!($bind = @ldap_bind($connect, "*", "*")))
    die("Unable to bind to server");
if ($connect) {
    $term = ($_GET['term']);
    $t=iconv('utf-8','cp1251', $term);
    $filter = "(&(objectClass=user)(objectCategory=person)(!(userAccountControl:1.2.840.113556.1.4.803:=2))(|(givenname=$t*)(sn=$t*)))";
    $sr = ldap_search($connect, $base_dn, $filter);
    $info = ldap_get_entries($connect, $sr);
    for ($i = 0; $i < $info["count"]; $i++) {
        $row_array['id'] = $info[$i]["mail"][0];
        //$row_array['id'] = $i;
        $row_array['value'] = iconv('cp1251', 'utf-8', $info[$i]["displayname"][0]);
        array_push($return_arr, $row_array);
    }
}
ldap_close($connect);

echo json_encode($return_arr);
?>
