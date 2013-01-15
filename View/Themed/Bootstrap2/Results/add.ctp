<?php echo $this->Form->create('Result');?>
<div class="row">
	<legend class="span10">Добавить результат</legend>
</div>
<div class="row">
	<?php if (isset($this->params['named']['second_stage_id'])) {
		echo $this->Form->input('second_stage_id', array('type' => 'hidden', 'value' => $this->params['named']['second_stage_id']));
	} else {
		echo $this->Form->input('second_stage_id', array('type' => 'hidden', 'value' => ''));
	}
	echo $this->Form->input('answer_source', array('class' => 'span3', 'label' => 'Источник ответа', 'div' => array('class' => 'span3'), 'options' => array('Архив РИЦ' => 'Архив РИЦ', 'Ведомства по РХ' => 'Ведомства по РХ', 'Другой РИЦ' => 'Другой РИЦ', 'Интернет' => 'Интернет', 'КЦ КП' => 'КЦ КП', 'Корпоративный сервер' => 'Корпоративный сервер', 'Нац. архив' => 'Нац. архив', 'Архив ОРВ РИЦ 188' => 'Архив ОРВ РИЦ 188', 'Официальный сайт' => 'Официальный сайт', 'СПС КП' => 'СПС КП')));
	echo $this->Form->input('answer_date', array('div' => array('class' => 'span2'), 'class' => 'span2', 'label' => 'Дата поступления', 'type' => 'text'));
	echo $this->Form->input('send_date', array('div' => array('class' => 'span2'), 'class' => 'span2', 'label' => 'Дата отправки', 'type' => 'text'));
	echo $this->Form->input('delivery', array('class' => 'span3', 'label' => 'Способ передачи', 'div' => array('class' => 'span3'), 'options' => array('Email' => 'Email', 'Звонок клиенту' => 'Звонок клиенту', 'Исх. письмо' => 'Исх. письмо', 'СИО' => 'СИО', 'Визит клиента' => 'Визит клиента')));?>
</div>
<div class="row">
	&nbsp;
</div>
<div class="row">
	<?php echo $this->Form->input('answer', array('div' => array('class' => 'span5'), 'class' => 'span5', 'label' => 'Ответ', 'type' => 'textarea'));
	echo $this->Form->input('note', array('div' => array('class' => 'span5'), 'class' => 'span5', 'label' => 'Примечания', 'type' => 'textarea'));	?>
</div>
<div class="row">
	<?php echo $this->Form->end(array('class' => 'btn btn-primary btn-large', 'label' => 'Сохранить', 'div' => array('class' => 'span2')));?>
</div>
<script language="javascript" type="text/javascript">
	// Календарь
	$('#ResultAnswerDate').datepicker();
	$('#ResultSendDate').datepicker();
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