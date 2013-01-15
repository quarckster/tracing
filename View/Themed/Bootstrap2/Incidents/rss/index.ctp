<?php
$this->set('channelData', array(
    'title' => __("Последние входящие"),
    'link' => $this->Html->url('/', true),
    'description' => __("Последние входящие"),
    'language' => 'ru-RU'
));

//App::uses('Sanitize', 'Utility');

foreach ($incidents as $incident) {
    $incidentTime = strtotime($incident['Incident']['start_date']);

    $incidentLink = array(
        'controller' => 'incidents',
        'action' => 'view',
        $incident['Incident']['id']
    );

    $header = "Дата регистрации: {$incident['Incident']['start_date']}<br>
				 Дата исполнения: {$incident['Incident']['exp_date']}<br>
				 Входящий номер: {$incident['Incident']['incoming_num']}<br>
		 		 Организация: {$incident['Incident']['organization']}<br>
	    		 Содержание: {$incident['Incident']['content']}<br>
				 Номер ТО: {$incident['Incident']['number_to']}<br>";
	if (!empty($incident['Detail'])) {
		$notified = array();
		$members = array();
		foreach ($incident['Detail'] as $detail){
			if ($detail['notify_only'] == 1) {
				$notified[] = $detail['user_sid'];
			} else {
				$members[] = $detail['comment_id'].'. '.$detail['user_sid'];
			}
		}
		$notified = implode(", ", $notified);
		$members = implode("<br>", $members);
	}
	if (!empty($notified)) {
		$notified = 'Уведомлены: '.$notified.'<br>';
	} else {
		$notified = null;
	}
	if (isset($members)) {
		$members = '<br>Участники маршрута:<br>'.$members;
	} else {
		$members = null;
	}

	$bodyText = $header.$notified.$members;

    echo  $this->Rss->item(array(), array(
        'title' => 'Входящее '.$incident['Incident']['incoming_num'].'. Номер ТО '.$incident['Incident']['number_to'].'. '.$incident['Incident']['content'],
        'link' => $incidentLink,
        'guid' => array('url' => $incidentLink, 'isPermaLink' => 'true'),
        'description' => $bodyText,
        'pubDate' => $incident['Incident']['start_date']
    ));
}