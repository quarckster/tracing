<?php
$this->set('channelData', array(
    'title' => __("Оставьте свой комментарий."),
    'link' => $this->Html->url('/', true),
    'description' => __("Вам надо оставить комментарий"),
    'language' => 'ru-RU'
));

//App::uses('Sanitize', 'Utility');

foreach ($incidents as $incident) {
    $incidentTime = strtotime($incident['Incident']['start_date']);

    $incidentLink = array(
        'controller' => 'incidents',
        'action' => 'view',
        $incident['Incident']['id'],
        'full_base' => True
    );

    $header = "Дата регистрации: {$incident['Incident']['start_date']}<br>
			   Дата исполнения: {$incident['Incident']['exp_date']}<br>
			   Входящий номер: {$incident['Incident']['incoming_num']}<br>
		 	   Организация: {$incident['Incident']['organization']}<br>
	    	   Содержание: {$incident['Incident']['content']}<br>
			   Номер ТО: {$incident['Incident']['number_to']}<br>";

	$notified = array();
	$members = array();
	foreach ($incident['Detail'] as $detail){
		if ($detail['notify_only'] == 1) {
			$notified[] = $detail['user_sid'];
		} elseif (!empty($detail['comment'])){
			$members[] = $detail['comment_id'].'. '.$detail['user_sid'].': '.$detail['comment'];
			$pubDate = strtotime($detail['comment_date']);
		} elseif ($detail['user_sid'] == $user_sid) {
			$members[] = $detail['comment_id'].'. '.$detail['user_sid'].': '.$this->Html->link('Оставьте свой комментарий', array('controller' => 'incidents', 'action' => 'edit_comment', 'full_base' => True, 'incident_id' => $detail['incident_id'], 'detail_id' => $detail['id']));
		} else {
			$members[] = $detail['comment_id'].'. '.$detail['user_sid'];
		}
 	}
	$members = 'Комментарии:<br>'.implode("<br>", $members);
	if (!empty($notified)) {
		$notified = implode(", ", $notified);
		$notified = 'Уведомлены: '.$notified.'<br>';
	} else {
		$notified = null;
	}
	$bodyText = $header.$notified.$members;

    echo  $this->Rss->item(array(), array(
        'title' => 'Входящее '.$incident['Incident']['incoming_num'].'. Номер ТО '.$incident['Incident']['number_to'].'. '.$incident['Incident']['content'],
        'link' => $incidentLink,
        'guid' => array('url' => $incidentLink, 'isPermaLink' => 'true'),
        'description' => $bodyText,
        'pubDate' => $pubDate
    ));
}
