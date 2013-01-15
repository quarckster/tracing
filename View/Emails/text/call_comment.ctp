Оставьте свой комментарий по ссылке http://tracing2/cake/edit_comment/calls_detail_id:<?php echo $calls_detail_id; ?>/call_id:<?php echo $call['Call']['id']; ?>
Входящее:
Зарегистрировал(а): <?php echo $call['Call']['user_sid']; ?>\r\n
Дата регистрации: <?php echo $call['Call']['open_date']; ?>\r\n
Организация: <?php echo $call['Call']['organization']; ?>\r\n
Контактные данные: <?php echo $call['Call']['contact_data']; ?>\r\n
Содержание: <?php echo $call['Call']['content']; ?>\r\n
Категория: <?php echo $call['Call']['category']; ?>\r\n
Участники:
№ п/п<?php echo Chr(9); ?>Имя
<?php if (!empty($call['CallsDetail'])):
	foreach ($call['CallsDetail'] as $calls_detail):
		echo $calls_detail['order'];
		echo Chr(9);
		echo $calls_detail['user_sid'];
		echo "\r\n";
	endforeach;
endif; ?>
