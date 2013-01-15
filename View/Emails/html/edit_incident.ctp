<div>
	Маршрут письма изменился. Оставьте свой комментарий по ссылке <a href="http://tracing2/incidents/edit_comment/incident_id:<?php echo $incident['Incident']['id']; ?>/detail_id:<?php echo $detail_id; ?>">http://tracing2/incidents/edit_comment/incident_id:<?php echo $incident['Incident']['id']; ?>/detail_id:<?php echo $detail_id; ?></a>
	<h3><a href="http://tracing2/incidents/view/<?php echo $incident['Incident']['id']; ?>">Входящее</a></h3>
		Дата регистрации: <?php echo $incident['Incident']['start_date']; ?><br>
		Дата исполнения: <?php echo $incident['Incident']['exp_date']; ?><br>
		Входящий номер: <?php echo $incident['Incident']['incoming_num']; ?><br>
		Организация: <?php echo $incident['Incident']['organization']; ?><br>
		Содержание: <?php echo $incident['Incident']['content']; ?><br>
		Номер ТО: <?php echo $incident['Incident']['number_to']; ?><br>
		<?php $notified = array();
		foreach ($incident['Detail'] as $detail0){
			if ($detail0['notify_only'] == 1) {
				$notified[] = $detail0['user_sid'];
			}
		}
		if (!empty($notified)):?>
		Уведомлены:	<?php echo implode(", ", $notified); ?>
		<?php endif; ?>
</div>
<div>
	<h3>Комментарии:</h3>
	<?php if (!empty($incident['Detail'])):?>
	<table cellpadding = "0" cellspacing = "10">

	<tr>
		<thead>
			<th align="left">№ п/п</th>
			<th align="left">Имя</th>
			<th align="left">Комментарий</th>
			<th align="left">Дата</th>
		</thead>
	</tr>
	<?php	foreach ($incident['Detail'] as $detail):
			if ($detail['notify_only'] != 1) {
				echo"
				<tr>
					<td>{$detail['comment_id']}</td>
					<td>{$detail['user_sid']}</td>
					<td>{$detail['comment']}</td>
					<td>{$detail['comment_date']}</td>
				</tr>";
			}
		endforeach; ?>
	</table>
	<?php endif; ?>
</div>
