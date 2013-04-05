Входящее:
Дата регистрации <?php echo $incident['Incident']['start_date']; ?>\r\n
Дата исполнения <?php echo $incident['Incident']['exp_date']; ?>\r\n
Входящий номер <?php echo $incident['Incident']['incoming_num']; ?>\r\n
Организация <?php echo $incident['Incident']['organization']; ?>\r\n
Содержание <?php echo $incident['Incident']['content']; ?>\r\n
Номер ТО <?php echo $incident['Incident']['number_to']; ?>\r\n
Участники:
№ п/п<?php echo Chr(9); ?>Имя
<?php if (!empty($incident['Detail'])):
	foreach ($incident['Detail'] as $detail):
		echo $detail['comment_id'];
		echo Chr(9);
		echo $detail['user_sid'];
		echo "\r\n";
	endforeach;
endif; ?>
Ссылка: http://tracing2/incident/view/<?php echo $incident['Incident']['id'];?>
