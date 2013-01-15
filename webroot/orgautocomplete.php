<?php
/* Connection vars here for example only. Consider a more secure method. */
$dbhost = 'localhost';
$dbuser = 'tracing';
$dbpass = 'tracing';
$dbname = 'tracing2';

$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');
mysql_select_db($dbname);
mysql_query("SET NAMES 'utf8';");
$return_arr = array();

/* If connection to database, run sql statement. */
if ($conn)
{
	$fetch = mysql_query("SELECT id, contact_data FROM calls WHERE contact_data LIKE '%" . mysql_real_escape_string($_GET['term']) . "%'"); 

	/* Retrieve and store in array the results of the query.*/
	while ($row = mysql_fetch_array($fetch, MYSQL_ASSOC)) {
		$row_array['id'] = $row['id'];
		$row_array['value'] = $row['contact_data'];

        array_push($return_arr,$row_array);
    }
}

/* Free connection resources. */
mysql_close($conn);

/* Toss back results as json encoded array. */
echo json_encode($return_arr);
?>
