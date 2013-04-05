<?php echo $this->Form->create('Outgoing');?>
<div class="row">
	<legend class="span12">Добавить исходящее</legend>
</div>
<div class="row">

	<?php if (isset($outgoing_numbers)) {
		echo $this->Form->input('Outgoing.outgoing_num', array('div' => array('class' => 'span5'), 'label' => 'Исходящий номер', 'class' => 'span5', 'placeholder' => implode(", ", $outgoing_numbers)));
	} else {
		echo $this->Form->input('Outgoing.outgoing_num', array('div' => array('class' => 'span3'), 'label' => 'Исходящий номер', 'class' => 'span3'));
	}
	echo $this->Form->input('Outgoing.executer', array('div' => array('class' => 'span4'), 'class' => 'span4', 'label' => 'Исполнитель'));
	echo $this->Form->input('Outgoing.date', array('div' => array('class' => 'span3'), 'class' => 'span3', 'label' => 'Дата', 'type' => 'text'));?>
</div>
<div class="row">&nbsp;</div>
<div class="row">
	<?php echo $this->Form->input('Outgoing.organization', array('div' => array('class' => 'span12'), 'class' => 'span12', 'label' => 'Организация'));?>
</div>
<div class="row">
	<?php echo $this->Form->input('Outgoing.content', array('div' => array('class' => 'span12'), 'rows' => 2, 'class' => 'span12', 'label' => 'Содержание'));?>
</div>
<div class="row">&nbsp;</div>
<div class="row">
	<?php echo $this->Form->input('Outgoing.folder', array('div' => 'span2', 'label' => array('class' => 'checkbox inline', 'text' => 'Наличие в папке'), 'type' => 'checkbox'));
	echo $this->Form->input('Outgoing.cis', array('div' => 'span2', 'label' => array('class' => 'checkbox inline', 'text' => 'Наличие в КИС'), 'type' => 'checkbox')); ?>
</div>
<div class="row">&nbsp;</div>
<div class="row">
	<?php echo $this->Form->end(array('class' => 'btn btn-primary btn-large', 'label' => 'Сохранить', 'div' => array('class' => 'span2')));?>
</div>
<script language="javascript" type="text/javascript">
	// Автозаполнение
	$("input#OutgoingExecuter").autocomplete({
		source: "/adnames.php",
		minLength: 2
	});
		// Календарь
	$('#OutgoingDate').datepicker();
	jQuery(function($){
		$.datepicker.regional['ru'] = {
			closeText: 'Закрыть',
			prevText: '&#x3c;Пред',
			nextText: 'След&#x3e;',
			currentText: 'Сегодня',
			monthNames: ['Январь','Февраль','Март','Апрель','Май','Июнь','Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'],
			monthNamesShort: ['Янв','Фев','Мар','Апр','Май','Июн','Июл','Авг','Сен','Окт','Ноя','Дек'],
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
