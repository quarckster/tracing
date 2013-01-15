<div>
<?php
	if (count($this->params['named']) >= '1' && isset($this->params['named']['filter'])) {
		echo null;
	} else {
		echo $this->Form->create('Incident', array('url' => array_merge(array('action' => 'find'), $this->params['pass']))); ?>
		<div class="row"><?php
			echo $this->Form->input('Incident.incoming_num', array('div' => array('class' => 'span2'), 'label' => 'Номер письма', 'class' => 'span2'));
			echo $this->Form->input('Incident.number_to', array('div' => array('class' => 'span2'), 'class' => 'span2', 'label' => 'Номер ТО'));
			echo $this->Form->input('Incident.exp_date', array('div' => array('class' => 'span2'), 'class' => 'span2', 'label' => 'Дата исполнения', 'type' => 'text'));
			echo $this->Form->input('Incident.content', array('div' => array('class' => 'span2'), 'class' => 'span2', 'label' => 'Содержание'));
			echo $this->Form->input('user_sid', array('div' => array('class' => 'span2'), 'class' => 'span2', 'label' => 'Имя участника'));
			echo $this->Form->input('filter', array( 'class' => 'span2', 'label' => 'Где искать', 'div' => array('class' => 'span2'), 'options' => array(null => 'Все входящие', 'in_progress' => 'В работе', 'archive' => 'Архив', 'delayed' => 'Просроченные', 'delayed_in_progress' => 'Просроченные в обработке', 'debt' => 'Об отключении за долги')));?>
		</div>
		<div class="row">
			<?php echo $this->Form->input('Incident.organization', array('div' => array('class' => 'span4'), 'class' => 'span4', 'label' => 'Организация'));
			echo $this->Form->input('range_from', array('div' => array('class' => 'span2'), 'class' => 'span2', 'label' => 'Начальная дата'));
			echo $this->Form->input('range_to', array('div' => array('class' => 'span2'), 'class' => 'span2', 'label' => 'Конечная дата'));?>
		</div>
		<div class="row"><?php
			echo $this->Form->end(array('class' => 'btn btn-primary btn-large', 'label' => 'Найти', 'div' => array('class' => 'span2')));?>
		</div>
<?php } ?>
	<div class="row">
			<?php if (isset($this->params['named']['filter']) && $this->params['named']['filter'] == 'archive')
				echo '<h2>Архив</h2>';
			if (isset($this->params['named']['filter']) && $this->params['named']['filter'] == 'delayed')
				echo '<h2>Просроченные обработанные</h2>';
			if (isset($this->params['named']['filter']) && $this->params['named']['filter'] == 'delayed_in_progress')
				echo '<h2>Просроченные в обработке</h2>';
			if (isset($this->params['named']['filter']) && $this->params['named']['filter'] == 'in_progress')
				echo '<div class="span2"><h2>В работе</h2></div><div class="span2 pull-right"><a href="'.Router::url($this->here, true).'.rss'.'">Подписаться на RSS</a></div>';
			if (isset($this->params['named']['filter']) && $this->params['named']['filter'] == 'debt')
				echo '<h2>Об отключении за долги</h2>';?>
	</div>
	<div class="row">
		<div class="span12">
			<?php echo $this->element('pagination'); ?>
		</div>
	</div>
	<table class="table table-striped table-bordered table-condensed">
		<col width="90" />
		<col width="auto" />
		<col width="90" />
		<col width="90" />
		<col width="60" />
		<col width="120" />
	<thead>
		<tr>
				<th>Номер входящего</th>
				<th>Организация</th>
				<th>Зарегистр.</th>
				<th>Дата исполнения</th>
				<th>Номер ТО</th>
				<th></th>
		</tr>
	</thead>
	<?php foreach ($incidents as $incident):?>
	<tr>
		<td><?php if ($incident['Incident']['incoming_num'] != '-1') echo $incident['Incident']['incoming_num']; ?>&nbsp;</td>
		<td><?php echo $incident['Incident']['organization']; ?>&nbsp;</td>
		<td><?php echo $incident['Incident']['start_date']; ?>&nbsp;</td>
		<td><?php echo $incident['Incident']['exp_date']; ?>&nbsp;</td>
		<td><?php echo $incident['Incident']['number_to']; ?>&nbsp;</td>
		<td><div class="btn-group">
			<?php echo $this->Html->link('<i class="icon-file"> </i>', array('action' => 'view', $incident['Incident']['id']), array('class' => 'btn', 'escape' => false)); 
			echo $this->Html->link('<i class="icon-edit"> </i>', array('action' => 'edit', $incident['Incident']['id']), array('class' => 'btn', 'escape' => false));
			echo $this->Html->link('<i class="icon-remove"> </i>', array('action' => 'delete', $incident['Incident']['id']), array('class' => 'btn', 'escape' => false));
			//echo $this->Html->image("b_view.png", array("alt" => "Просмотр", 'url' => array('action' => 'view', $incident['Incident']['id'])));
			//echo $this->Html->image("b_edit.png", array("alt" => "Редактировать", 'url' => array('action' => 'edit', $incident['Incident']['id'])));
			//echo $this->Html->link($this->Html->image("b_drop.png", array("alt" => "Удалить")), array('action' => 'delete', $incident['Incident']['id']), array('escape' => false), 'Вы уверены, что хотите удалить это входящее?'); ?>
		</div></td>
	</tr>
	<?php endforeach; ?>
	</table>
	<?php echo $this->element('pagination');
	//endif; ?>
</div>
<script language="javascript" type="text/javascript">
	$("input#IncidentUserSid").autocomplete({
		source: "/adnames.php",
		minLength: 2
	});
	// Календарь
	$('#IncidentExpDate').datepicker();
	$(function() {
		$( "#IncidentRangeFrom" ).datepicker({
			changeMonth: true,
			numberOfMonths: 2,
			onSelect: function( selectedDate ) {
				$( "#IncidentRangeTo" ).datepicker( "option", "minDate", selectedDate );
			}
		});
		$( "#IncidentRangeTo" ).datepicker({
			changeMonth: true,
			numberOfMonths: 2,
			onSelect: function( selectedDate ) {
				$( "#IncidentRangeFrom" ).datepicker( "option", "maxDate", selectedDate );
			}
		});
	});
	jQuery(function($){
		$.datepicker.regional['ru'] = {
			closeText: 'Закрыть',
			prevText: '&#x3c;Пред',
			nextText: 'След&#x3e;',
			currentText: 'Сегодня',
			monthNames: ['Январь','Февраль','Март','Апрель','Май','Июнь',
				'Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'],
			monthNamesShort: ['Янв','Фев','Мар','Апр','Май','Июн',
				'Июл','Авг','Сен','Окт','Ноя','Дек'],
			dayNames: ['воскресенье','понедельник','вторник','среда','четверг','пятница','суббота'],
			dayNamesShort: ['вск','пнд','втр','срд','чтв','птн','сбт'],
			dayNamesMin: ['Вс','Пн','Вт','Ср','Чт','Пт','Сб'],
			weekHeader: 'Не',
			dateFormat: 'yy-mm-dd',
			firstDay: 1,
			isRTL: false,
			showMonthAfterYear: false,
			yearSuffix: ''};
		$.datepicker.setDefaults($.datepicker.regional['ru']);
	});              
</script>
