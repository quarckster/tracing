<div class="incidents form">
<?php echo $this->Form->create('Incident');?>
	<fieldset>
		<legend>Редактировать входящее</legend>
	<?php
		echo $this->Form->input('Incident.id', array('type' => 'hidden', 'value' => $this->data[0]['Incident']['id']));
		echo $this->Form->input('Incident.incoming_num', array('label' => 'Входящий номер', 'value' => $this->data[0]['Incident']['incoming_num']));
		echo $this->Form->input('Incident.organization', array('label' => 'Организация', 'value' => $this->data[0]['Incident']['organization']));
		echo $this->Form->input('Incident.number_to', array('label' => 'Номер ТО', 'value' => $this->data[0]['Incident']['number_to']));
		//echo $this->Form->input('Incident.start_date', array( 'label' => 'Дата регистрации', 'value' => $this->data[0]['Incident']['start_date']));
		echo $this->Form->input('Incident.exp_date', array( 'label' => 'Дата исполнения', 'type' => 'text', 'value' => $this->data[0]['Incident']['exp_date']));
		echo $this->Form->input('Incident.content', array('rows' => '3', 'label' => 'Содержание', 'value' => $this->data[0]['Incident']['content']));
		/*echo $this->Form->input('Incident.status', array('label' => '╨б╤В╨░╤В╤Г╤Б'));*/
		$notified = array();
		foreach ($this->data[0]['Detail'] as $detail0):
			if ($detail0['notify_only'] == 1) {
			$notified[] = $detail0['user_sid'];
			}
		endforeach;
		//echo "<dt>Уведомлены"implode(", ", $notified);
		echo $this->Html->tag('label', 'Уведомлены: ' . implode(", ", $notified));
		//if (!empty($this->data['Call']['notified'])) {
		//	echo $this->Html->tag('label', 'Уведомлены: ' . $this->data['Call']['notified']);
		//}
	?>
	
<table cellpadding = "0" cellspacing = "0">
		<col width="20" />
		<col width="200" />
		<col width="50" />
	<tr>
		<th>№ п/п</th>
		<th>Имя</th>
		<th>&nbsp;</th>
	</tr>
	<?php	
		$i=0;
		foreach ($this->data[0]['Detail'] as $detail):
	?>
	<tr>
		<?php
			if (empty($detail['comment']) && $detail['notify_only'] != 1) {
				echo $this->Form->input('Detail.'. $i .'.id', array('type' => 'hidden', 'value' => $detail['id']));
		?>

				<td><?php echo $detail['comment_id']; ?></td>
				<td><?php echo $this->Form->input('Detail.'. $i .'.user_sid', array('label' => false, 'value' => $detail['user_sid'], 'id' => 'DetailUserSid')); ?></td>
				<td><?php echo $this->Html->link($this->Html->image("b_drop.png", array("alt" => "Удалить")), array('controller' => 'details', 'action' => 'delete', $detail['id']), array('escape' => false), 'Вы уверены, что хотите удалить это?');
						//$this->Html->link(__('Удалить', true), array('controller' => 'details', 'action' => 'delete', $detail['id']), null, sprintf(__('Вы уверены, что хотите участника %s?', true), $detail['user_sid']));
					echo "&#09;";
					echo $this->Html->image("down-arrow.jpg", array("alt" => "Добавить после", 'url' => array('controller' => 'details', 'action' => 'add', $detail['id'], 'after')));
					echo "&#09;";
					echo $this->Html->image("up-arrow.jpg", array("alt" => "Добавить перед", 'url' => array('controller' => 'details', 'action' => 'add', $detail['id'], 'before')));
					//echo $this->Html->link(__('тЖУ', true), array('controller' => 'details', 'action' => 'add', $detail['id'], 'after'));
					//echo $this->Html->link(__('тЖС', true), array('controller' => 'details', 'action' => 'add', $detail['id'], 'before'));
				?></td>

	</tr>
	<?php  
			} 
			if (!empty($detail['comment']) && $detail['notify_only'] != 1) {
	?>
				<td><?php echo $detail['comment_id']; ?></td>
				<td><?php echo $detail['user_sid']; ?></td>
				<td>&nbsp;</td>
		
	<?php		}
		$i++;
		endforeach;
	?>
</table>
	</fieldset>
<?php echo $this->Form->end(__('Сохранить', true));?>
</div>
<div class="actions">
	<h3>Ссылки</h3>
	<ul>
		<li><?php echo $this->Html->link(__('Главная', true), '/'); ?></li>
		<li><?php echo $this->Html->link(__('Обращения', true), array('controller' => 'calls', 'action' => 'index')); ?></li>
	</ul>
<h3>Действия</h3>
	<ul>

		<li><?php echo $this->Html->link(__('Удалить', true), array('action' => 'delete', $this->Form->value('Incident.id')), null, sprintf(__('Вы уверены, что хотите удалить это входящее?', true), $this->Form->value('Incident.id'))); ?></li>
		<li><?php echo $this->Html->link(__('История изменений', true), array('action' => 'history', $this->data[0]['Incident']['id'])); ?> </li>
	</ul>
	<h3>Фильтры</h3>
	<ul>
		<li><?php echo $this->Html->link(__('Все', true), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('Просроченные обр-ые', true), array('action' => 'find', 'filter' => 'delayed')); ?></li>
		<li><?php echo $this->Html->link(__('Просроченные необр-ые', true), array('action' => 'find', 'filter' => 'delayed_in_progress')); ?></li>
		<li><?php echo $this->Html->link(__('В работе', true), array('action' => 'find', 'filter' => 'in_progress')); ?></li>
		<li><?php echo $this->Html->link(__('Об откл. за долги', true), array('action' => 'find', 'filter' => 'debt')); ?></li>
		<li><hr size="0" /></li>
		<li><?php echo $this->Html->link(__('Поиск', true), array('action' => 'find')); ?></li>
	</ul>
</div>
<script language="javascript" type="text/javascript">
                // Автозаполнение
                $("input#DetailUserSid").autocomplete({
                    source: "/adnames.php",
                    minLength: 2
                });
            // Календарь
            $('#IncidentExpDate').datepicker();
            jQuery(function($){
                $.datepicker.regional['ru'] = {
                    closeText: 'Закрыть',
                    prevText: '<Пред',
                    nextText: 'След>',
                    currentText: 'Сегодня',
                    monthNames: ['Январь','Февраль','Март','Апрель','Май','Июнь',
                        'Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'],
                    monthNamesShort: ['Янв','Фев','Мар','Апр','Май','Июн',
                        'Июл','Авг','Сен','Окт','Ноя','Дек'],
                    dayNames: ['воскресенье','понедельник','вторник','среда','четверг','пятница','суббота'],
                    dayNamesShort: ['вск','пнд','втр','срд','чтв','птн','сбт'],
                    dayNamesMin: ['Вс','Пн','Вт','Ср','Чт','Пт','Сб'],
                    weekHeader: 'Не',
                    dateFormat: 'dd.mm.yy',
                    firstDay: 1,
                    isRTL: false,
                    showMonthAfterYear: false,
                    yearSuffix: ''};
                $.datepicker.setDefaults($.datepicker.regional['ru']);
            });
</script>
