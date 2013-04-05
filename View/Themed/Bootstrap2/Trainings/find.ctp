<div>
<?php
	if (count($this->params['named']) >= '1' && isset($this->params['named']['filter'])) {
		echo null;
	} else {
		echo $this->Form->create('Training', array('url' => array_merge(array('action' => 'find'), $this->params['pass']))); ?>
		<div class="row"><?php
			echo $this->Form->input('Training.id', array('div' => array('class' => 'span2'), 'label' => 'Номер письма', 'class' => 'span2', 'type' => 'text'));
			echo $this->Form->input('Training.number_to', array('div' => array('class' => 'span2'), 'class' => 'span2', 'label' => 'Номер ТО', 'type' => 'text'));
			echo $this->Form->input('Training.town', array('div' => array('class' => 'span2'), 'class' => 'span2', 'label' => 'Город', 'type' => 'text'));
			echo $this->Form->input('Training.purpose', array('div' => array('class' => 'span2'), 'class' => 'span2', 'label' => 'Цель'));
			echo $this->Form->input('user_sid', array('div' => array('class' => 'span2'), 'class' => 'span2', 'label' => 'Имя специалиста'));?>
		</div>
		<div class="row">
			<?php echo $this->Form->input('range_from', array('div' => array('class' => 'span2'), 'class' => 'span2', 'label' => 'Начальная дата'));
			echo $this->Form->input('range_to', array('div' => array('class' => 'span2'), 'class' => 'span2', 'label' => 'Конечная дата'));?>
		</div>
		<div class="row"><?php
			echo $this->Form->end(array('class' => 'btn btn-primary btn-large', 'label' => 'Найти', 'div' => array('class' => 'span2')));?>
		</div>
<?php } ?>
<h2>Заявки на обучение</h2>
<?php if (isset($this->params['named']['filter']) && $this->params['named']['filter'] == 'in_progress')
	echo '<h3>Обучение не проведено</h3>';
if (isset($this->params['named']['filter']) && $this->params['named']['filter'] == 'expired')
	echo '<h3>Просроченные</h3>';
if (isset($this->params['named']['filter']) && $this->params['named']['filter'] == 'not_completed')
	echo '<h3>Незавершённые</h3>';
if (isset($this->params['named']['filter']) && $this->params['named']['filter'] == 'urgenеtly')
	echo '<h3>Срочные</h3>';
if (isset($this->params['named']['filter']) && $this->params['named']['filter'] == 'completed')
	echo '<h3>Завершённые</h3>';
if (isset($this->params['named']['filter']) && $this->params['named']['filter'] == 'new')
	echo '<h3>Новые</h3>';?>
<?php echo $this->element('pagination'); ?>

	<table class="table table-striped table-bordered table-condensed">
	<col width="55" />
	<col width="95" />
	<col width="90" />
	<col width="auto" />
	<col width="55" />
	<col width="90" />
	<col width="auto" />
	<col width="55" />
	<col width="90" />
	<col width="120" />
	<thead>
		<tr>
			<th>Номер заявки</th>
			<th><a href="#" data-toggle="popover" data-placement="top" data-content="П - поступление заявки; О - обучение проведено; З - завершение; К - дата контроля" title data-original-title="Легенда" id="tooltip1">Даты*</a></th>
			<th>Специалист</th>
			<th>Организация</th>
			<th>Номер ТО</th>
			<th>Город</th>
			<th>Цель обучения</th>
			<th>Оборудование</th>
			<th>Преподаватель</th>
			<th></th>
		</tr>
	</thead>
	<?php
	foreach ($trainings as $training): ?>
	<tr>
		<td><?php echo $training['Training']['id']; ?>&nbsp;</td>
		<td>П:<?php echo $training['Training']['date_receipt']; ?><br>О:<?php echo $training['Training']['date_training']; ?><br>З:<?php echo $training['Training']['date_end']; if(!empty($training['Training']['date_control'])) {echo '<br>К:'.$training['Training']['date_control'];} ?>&nbsp;</td>
		<td><?php echo $training['Training']['user_sid']; ?>&nbsp;</td>
		<td><?php echo $training['Training']['organization']; ?>&nbsp;</td>
		<td><?php echo $training['Training']['number_to']; ?>&nbsp;</td>
		<td><?php echo $training['Training']['town']; ?>&nbsp;</td>
		<td><?php echo $training['Training']['purpose']; ?>&nbsp;</td>
		<td><?php echo $training['Training']['tso']; ?>&nbsp;</td>
		<td><?php echo $training['Training']['mentor_sid']; ?>&nbsp;</td>
		<td><div class="btn-group"><?php
			echo $this->Html->link('<i class="icon-file"> </i>', array('action' => 'view', $training['Training']['id']), array('title' => 'Открыть', 'class' => 'btn', 'escape' => false)); 
			echo $this->Html->link('<i class="icon-edit"> </i>', array('action' => 'edit', $training['Training']['id']), array('title' => 'Редактировать', 'class' => 'btn', 'escape' => false));
			echo $this->Form->postLink('<i class="icon-remove"> </i>', array('action' => 'delete', $training['Training']['id']), array('title' => 'Удалить', 'class' => 'btn', 'escape' => false), 'Вы уверены, что хотите удалить это входящее?');?>
		</div></td>
	</tr>
<?php endforeach; ?>
</table>
<?php echo $this->element('pagination'); ?>
<script>
	$('#tooltip1').popover();
	$("input#TrainingUserSid").autocomplete({
		source: "/adnames.php",
		minLength: 2
	});
	// Календарь
	$('#TrainingDateReceipt').datepicker();
	$(function() {
		$( "#TrainingRangeFrom" ).datepicker({
			changeMonth: true,
			numberOfMonths: 2,
			onSelect: function( selectedDate ) {
				$( "#TrainingRangeTo" ).datepicker( "option", "minDate", selectedDate );
			}
		});
		$( "#TrainingRangeTo" ).datepicker({
			changeMonth: true,
			numberOfMonths: 2,
			onSelect: function( selectedDate ) {
				$( "#TrainingRangeFrom" ).datepicker( "option", "maxDate", selectedDate );
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
