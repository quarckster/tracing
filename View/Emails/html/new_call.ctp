<div>
	<h3><a href="http://tracing2/calls/view/<?php echo $call['Call']['id']; ?>">Обращение</a></h3>
		Зарегистрировано новое обращение. Перейдите по этой ссылке <a target="_blank" href="http://tracing2/calls/view/<?php echo $call['Call']['id']; ?>">http://tracing2/calls/view/<?php echo $call['Call']['id']; ?></a>, чтобы оставить комментарий.
		Зарегистрировал(а): <?php echo $call['Call']['user_sid']; ?><br>
		Дата регистрации: <?php echo $call['Call']['open_date']; ?><br>
		Организация: <?php echo $call['Call']['organization']; ?><br>
		Контактные данные: <?php echo $call['Call']['contact_data']; ?><br>
		Содержание: <?php echo $call['Call']['content']; ?><br>
		Категория: <?php echo $call['Call']['category']; ?><br>
		<?php if (!empty($call['Call']['notified'])): ?>Уведомлены: <?php echo $call['Call']['notified']; ?><?php endif;?>
</div>
<?php if (!empty($call['CallsDetail'])): ?>
<div>
	<h3>Участники</h3>
	<table cellpadding = "0" cellspacing = "10">
	<tr>
		<th align="left">№ п/п</th>
		<th align="left">Имя</th>
	</tr>
	<?php	foreach ($call['CallsDetail'] as $calls_detail):
			echo"
				<tr>
					<td>{$calls_detail['order']}</td>
					<td>{$calls_detail['user_sid']}</td>
				</tr>";
		endforeach; ?>
	</table>
</div>
<?php endif; ?>
