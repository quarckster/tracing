<div>
	Оставьте свой комментарий по <a href="http://tracing2/calls/edit_comment/calls_detail_id:<?php echo $calls_detail_id['Call']['calls_detail_id']; ?>/call_id:<?php echo $call['Call']['id']; ?>">этой ссылке</a>
	<h3><a href="http://cake/calls/view/<?php echo $call['Call']['id']; ?>">Входящее</a></h3>
		Зарегистрировал(а): <?php echo $call['Call']['user_sid']; ?><br>
		Дата регистрации: <?php echo $call['Call']['open_date']; ?><br>
		Организация: <?php echo $call['Call']['organization']; ?><br>
		Контактные данные: <?php echo $call['Call']['contact_data']; ?><br>
		Содержание: <?php echo $call['Call']['content']; ?><br>
		Категория: <?php echo $call['Call']['category']; ?>
</div>
<div>
	<h3>Комментарии:</h3>
	<?php if (!empty($call['CallsDetail'])):?>
	<table cellpadding = "0" cellspacing = "10">
	<tr>
		<thead>
			<th align="left">№ п/п</th>
			<th align="left">Имя</th>
			<th align="left">Комментарий</th>
			<th align="left">Дата</th>
		</thead>
	</tr>
	<?php foreach ($call['CallsDetail'] as $calls_detail):
				echo"
				<tr>
					<td>{$calls_detail['order']}</td>
					<td>{$calls_detail['user_sid']}</td>
					<td>{$calls_detail['comment']}</td>
					<td>{$calls_detail['date']}</td>
				</tr>";
		endforeach; ?>
	</table>
	<?php endif; ?>
</div>
