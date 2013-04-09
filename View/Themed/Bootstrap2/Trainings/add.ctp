<?php 
echo $this->Form->create('Training');?>
<div class="row">
	<legend class="span10 offset1">Добавить заявку на обучение</legend>
</div>
<div class="row">
	<?php echo $this->Form->input('Training.user_sid', array('div' => array('class' => 'span2 offset1'), 'label' => 'Ваше имя', 'class' => 'span2'));
	echo $this->Form->input('Training.purpose', array('div' => array('class' => 'span5'), 'label' => 'Цель обучения', 'class' => 'span5'));
	echo $this->Form->input('Training.kind_training', array('div' => array('class' => 'span2'), 'label' => 'Вид обучения', 'class' => 'span2', 'options' => array('Индивидуальное' => 'Индивидуальное', 'Коллективное' => 'Коллективное')));?>
</div>
<div class="row">
&nbsp;
</div>
<div class="row">
	<?php echo $this->Form->input('Training.number_to', array('div' => array('class' => 'span1 offset1'), 'class' => 'span1', 'label' => 'Номер ТО', 'type' => 'text'));
	echo $this->Form->input('Training.organization', array('div' => array('class' => 'span4'), 'class' => 'span4', 'label' => 'Организация'));
	echo $this->Form->input('Training.town', array('div' => array('class' => 'span2'), 'class' => 'span2', 'label' => 'Город'));
	echo $this->Form->input('Training.address_fact', array('div' => array('class' => 'span3'), 'class' => 'span3', 'label' => 'Адрес'));
	// echo $this->Form->input('Training.transport', array('div' => array('class' => 'span2'), 'class' => 'span2', 'label' => 'Транспорт'));
	?>
</div>
<div class="row">
&nbsp;
</div>
<div class="row">
	<?php echo $this->Form->input('Training.systems_set', array('div' => array('class' => 'span3 offset1'), 'class' => 'span3', 'label' => 'Комплект систем'));
	echo $this->Form->input('Training.amount', array('div' => array('class' => 'span1'), 'class' => 'span1', 'label' => 'Cумма'));
	echo $this->Form->input('Training.competitors', array('div' => array('class' => 'span2'), 'class' => 'span2', 'label' => 'Конкуренты'));
	echo $this->Form->input('Training.tso', array('div' => array('class' => 'span2'), 'class' => 'span2', 'label' => 'Оборудование', 'options' => array('Нет' => 'Нет', 'Ноутбук' => 'Ноутбук', 'Флеш' => 'Флеш')));
	echo $this->Form->input('Training.additional_info', array('div' => array('class' => 'span2'), 'label' => 'Доп. информация', 'class' => 'span2'));?>
</div>
<div class="row">
&nbsp;
</div>
<div class="row">
	<div class="span3 offset1">
		<h4>Список контактных лиц клиента</h4>
	</div>
	<div class="span3">
			<?php echo $this->Html->link('Добавить', '#add', array('class' => 'btn', 'id' => 'button_add'));?>
			<?php echo $this->Html->link('Удалить', '#remove', array('class' => 'btn', 'id' => 'button_remove'));?>
	</div>
</div>
<div class="row">
&nbsp;
</div>
<input id="TrainingsContactName-0" type="hidden">
<div class="row">
	<?php echo $this->Form->end(array('class' => 'btn btn-primary btn-medium', 'label' => 'Сохранить', 'div' => array('class' => 'span2 offset1')));?>
</div>
<script language="javascript" type="text/javascript">
	$("input#TrainingUserSid").autocomplete({
		source: "/adnames.php",
		minLength: 2
			});
	$('#button_add').click(function(){
		num = $("input[id*='TrainingsContactName-']").length;
		var newDiv = $('<div id="TrainingsContactName-' + num + '" class="row"><div class="span3 offset1"><label for="TrainingsContactName-' + num + '">ФИО</label><div class="input-prepend"><span class="add-on">' + num + '</span><input name="data[TrainingsContact][' + num + '][name]" class="span3" type="text" id="TrainingsContactName-' + num + '"/></div></div><div class="span3"><label for="TrainingsContactOccupation-' + num + '">Должность</label><input name="data[TrainingsContact][' + num + '][occupation]" class="span3" type="text" id="TrainingsContactOccupation-' + num + '"/></div><div class="span2"><label for="TrainingsContactPhone-' + num + '">Телефон</label><input name="data[TrainingsContact][' + num + '][phone]" class="span2" type="text" id="TrainingsContactPhone-' + num + '"/></div><div class="span2"><label for="TrainingsContactMisc-' + num + '">Примечание</label><input name="data[TrainingsContact][' + num + '][misc]" class="span2" type="text" id="TrainingsContactMisc-' + num + '"/></div></div>');
		$('#TrainingsContactName-0').before(newDiv);
		});
	$('#button_remove').click(function(){
		num = $("input[id*='TrainingsContactName-']").length - 1;
		$('div#TrainingsContactName-' + num + '').children().remove();
		$('div#TrainingsContactName-' + num + '').remove();
	});
	$("input#TrainingDateControl").datepicker();
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