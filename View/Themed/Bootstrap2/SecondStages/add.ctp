<?php echo $this->Form->create('SecondStage');?>
<div class="row">
	<legend class="span10">Добавить второй этап</legend>
</div>
<div class="row">
	<?php if (isset($this->params['named']['call_id'])) {
		echo $this->Form->input('call_id', array('type' => 'hidden', 'value' => $this->params['named']['call_id']));
	} else {
		echo $this->Form->input('call_id', array('type' => 'hidden', 'value' => ''));
	}
	echo $this->Form->input('order_number', array('div' => array('class' => 'span2'), 'class' => 'span2', 'label' => 'Номер заказа' ));
	echo $this->Form->input('date', array('div' => array('class' => 'span2'), 'class' => 'span2', 'label' => 'Дата заказа', 'type' => 'text'));
	echo $this->Form->input('order_in', array('class' => 'span2', 'label' => 'Заказ в', 'div' => array('class' => 'span2 offset1'), 'options' => array('КЦ' => 'КЦ', 'РХ' => 'РХ', 'Другие РИЦ' => 'Другие РИЦ')));
	echo $this->Form->input('order_way', array('class' => 'span3', 'label' => 'Способ заказа', 'div' => array('class' => 'span3'), 'options' => array('Корпоративный сервер' => 'Корпоративный сервер', 'Email' => 'Email', 'Звонок' => 'Звонок', 'Письмо' => 'Письмо'))); ?>
</div>
<div class="row">
	&nbsp;
</div>
<div class="row">
	<?php echo $this->Form->input('additional_info', array('type' => 'textarea', 'div' => array('class' => 'span5'), 'class' => 'span5', 'label' => 'Доп. информация и иные особенности заказа')); ?>
	<?php echo $this->Form->input('note', array('type' => 'textarea', 'div' => array('class' => 'span5'), 'class' => 'span5', 'label' => 'Примечания')); ?>
</div>
<div class="row">
	&nbsp;
</div>
<div class="row">
	<?php echo $this->Form->end(array('class' => 'btn btn-primary btn-large', 'label' => 'Сохранить', 'div' => array('class' => 'span2')));?>
</div>

<script language="javascript" type="text/javascript">
	// Календарь
	$('#SecondStageDate').datepicker();
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