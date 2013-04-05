<?php echo $this->Form->create('PreliminaryResponse');?>
<div class="row">
	<legend class="span6 offset3">Добавить предварительный ответ</legend>
</div>
<div class="row">
	<?php if (isset($this->params['named']['second_stage_id'])) {
		echo $this->Form->input('second_stage_id', array('type' => 'hidden', 'value' => $this->params['named']['second_stage_id']));
	} else {
		echo $this->Form->input('second_stage_id', array('type' => 'hidden', 'value' => ''));
	}
	echo $this->Form->input('answer_date', array('div' => array('class' => 'span2 offset3'), 'class' => 'span2', 'label' => 'Дата поступления', 'type' => 'text'));
	echo $this->Form->input('send_date', array('div' => array('class' => 'span2'), 'class' => 'span2', 'label' => 'Дата отправки', 'type' => 'text'));
	echo $this->Form->input('delivery', array('class' => 'span2', 'label' => 'Способ передачи', 'div' => array('class' => 'span2'), 'options' => array('Без передачи' => 'Без передачи', 'Email' => 'email', 'Исх. письмо' => 'Исх. письмо', 'Звонок клиенту' => 'Звонок клиенту', 'СИО' => 'СИО', 'Визит клиента' => 'Визит клиента')));?>
</div>
<div class="row">
	&nbsp;
</div>
<div class="row">
	<?php echo $this->Form->input('answer', array('div' => array('class' => 'span6 offset3'), 'class' => 'span6', 'label' => 'Ответ', 'type' => 'textarea'))?>
</div>
<div class="row">
	&nbsp;
</div>
<div class="row">
	<?php echo $this->Form->input('cis_template', array('div' => array('class' => 'span2 offset3'), 'label' => array('class' => 'checkbox inline', 'text' => 'Шаблон КИС'), 'type' => 'checkbox'));?>
</div>
<div class="row">
	&nbsp;
</div>
<div class="row">
	<?php echo $this->Form->end(array('class' => 'btn btn-primary btn-large', 'label' => 'Сохранить', 'div' => array('class' => 'span2 offset3')));?>
</div>

<script language="javascript" type="text/javascript">
	// Календарь
	$('#PreliminaryResponseAnswerDate').datepicker();
	$('#PreliminaryResponseSendDate').datepicker();
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