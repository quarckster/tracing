<?php
App::uses('AppModel', 'Model');
/**
 * DetailsRev Model
 *
 */
class DetailsRev extends AppModel {

	function afterFind($results) {
	    foreach ($results as $key => $val) {
		if (isset($val['DetailsRev']['modify_time'])) {
		    $timestamp = strtotime($results[$key]['DetailsRev']['modify_time']);
		    $results[$key]['DetailsRev']['modify_time'] = date('d.m.Y H:i', $timestamp);
		}
	    }
	    return $results;
	}

}
