<div>
<?php
/**
 * Проверяем наличие в адресной строке параметров. Если обнаруживаем больше или равным одному и если содержится
 * слово "category", то форму поиска не рисуем.
 */
if (count($this->params['named']) >= '1' && (isset($this->params['named']['category']) || isset($this->params['named']['filter']) || isset($this->params['named']['control']) || isset($this->params['named']['close_date']))) {
	echo null;
} else {
	echo $this->Form->create('Call', array('url' => array_merge(array('action' => 'find'), $this->params['pass'])));?>
<div class="row">
	<?php echo $this->Form->input('user_sid', array('div' => array('class' => 'span2'), 'class' => 'span2', 'label' => 'Кто зарегистрировал'));
	echo $this->Form->input('number_to', array('div' => array('class' => 'span2'), 'class' => 'span2', 'label' => 'Номер ТО'));
	echo $this->Form->input('category', array('label' => 'Категория', 'div' => array('class' => 'span2'), 'class' => 'span2', 'options' => array(null => 'Все', 'ЗД' => 'Заказ документов', 'Сбой' => 'Сбой', 'Инф.' => 'Информационный', 'Демо' => 'Демоверсия', 'КФВ' => 'Консультации по ФВ')));
	echo $this->Form->input('delivery', array('label' => 'Способ обращения', 'div' => array('class' => 'span2'), 'class' => 'span2', 'options' => array(null => 'Все', 'Звонок' => 'Звонок', 'Сайт' => 'Сайт', 'Email' => 'Email', 'СИО' => 'СИО', 'Визит' => 'Визит')));
	echo $this->Form->input('cis_template', array('div' => array('class' => 'span2'), 'class' => 'span2', 'label' => 'Шаблон КИС', 'options' => array(null => 'Все', '0' => 'Без шаблона', '1' => 'С шаблоном')));
	echo $this->Form->input('control', array('div' => array('class' => 'span2'), 'class' => 'span2', 'label' => 'На контролe', 'options' => array(null => 'Все', '0' => 'Нет', '1' => 'Да')));?>
</div>
<div class="row">
	<?php echo $this->Form->input('organization', array('div' => array('class' => 'span4'), 'class' => 'span4', 'label' => 'Организация'));
	echo $this->Form->input('contact_data', array('div' => array('class' => 'span4'), 'class' => 'span4', 'label' => 'Контактные данные', 'type' => 'text'));
	echo $this->Form->input('content', array('div' => array('class' => 'span4'), 'class' => 'span4', 'label' => 'Содержание', 'type' => 'text'));?>
</div>
<div class="row">
	<?php echo $this->Form->input('range_from', array('div' => array('class' => 'span2'), 'class' => 'span2', 'label' => 'Начальная дата'));
	echo $this->Form->input('range_to', array('div' => array('class' => 'span2'), 'class' => 'span2', 'label' => 'Конечная дата'));  ?>
</div>
<div class="row">
	<?php echo $this->Form->end(array('class' => 'btn btn-primary btn-large', 'label' => 'Найти', 'div' => array('class' => 'span2')));
}?>
</div>
<h2><?php
	if (isset($this->params['named']['category']) && $this->params['named']['category'] == 'ЗД')
		echo 'Заказ документов';
	if (isset($this->params['named']['category']) && $this->params['named']['category'] == 'Сбой')
		echo 'Сбой';
	if (isset($this->params['named']['category']) && $this->params['named']['category'] == 'Инф.')
		echo 'Информационные';
	if (isset($this->params['named']['category']) && $this->params['named']['category'] == 'Демо')
		echo 'Демоверсия';
	if (isset($this->params['named']['category']) && $this->params['named']['category'] == 'КФВ')
		echo 'Консультации по формализованным вопросам';		
	if (isset($this->params['named']['control']) && $this->params['named']['control'] == '1')
		echo 'На контроле';
?></h2>
<?php //if (!empty($this->params['named'])):
		echo $this->element('pagination'); ?>
<table class="table table-striped table-bordered table-condensed">
	<col width="80" />		
	<col width="95" />
	<col width="50" />
	<col width="auto" />
	<col width="auto" />
	<col width="170" />
	<col width="40" />
	<col width="130" />
	<thead>
		<tr>
			<th>Имя</th>
			<th>Даты</th>
			<th>Кат.</th>
			<th>Организация</th>
			<th>Контактные данные</th>
			<th>Предпр. действия</th>
			<th>КИС</th>
			<th></th>
		</tr>
	</thead>
	<?php foreach ($calls as $call):?>
	<tr>
		<td><?php echo $call['Call']['user_sid']; ?>&nbsp;</td>
		<td>О:&nbsp;<?php echo $call['Call']['open_date']; ?><br>З:&nbsp;<?php echo $call['Call']['close_date']; ?>&nbsp;</td>
		<td><?php echo $call['Call']['category']; ?>&nbsp;</td>
		<td><?php echo $call['Call']['organization']; ?>&nbsp;</td>
		<td><?php echo $call['Call']['contact_data']; ?>&nbsp;</td>
		<td><?php echo $call['Call']['actions']; ?>&nbsp;</td>
		<td><?php if ($call['Call']['cis_template'] == 1){ echo '<i class="icon-ok aligncenter"> </i>'; } ?>&nbsp;</td>
		<td>
			<div class="btn-group pull-right"><?php
				echo $this->Html->link('<i class="icon-file"> </i>', array('action' => 'view', $call['Call']['id']), array('class' => 'btn', 'escape' => false)); 
				echo $this->Html->link('<i class="icon-edit"> </i>', array('action' => 'edit', $call['Call']['id']), array('class' => 'btn', 'escape' => false));
				echo $this->Html->link('<i class="icon-remove"> </i>', array('action' => 'delete', $call['Call']['id']), array('class' => 'btn', 'escape' => false, 'Вы уверены, что хотите удалить это обращение?'));?>
			</div>
		</td>
	</tr>
	<?php endforeach; ?>
</table>
<?php echo $this->element('pagination');
	//endif; ?>
</div>
<script language="javascript" type="text/javascript">
	//Автозаполнение
	$("input#CallUserSid").autocomplete({
		source: "/adnames.php",
		minLength: 2
	});
	// Календарь
	$(function() {
		$( "#CallRangeFrom" ).datepicker({
			changeMonth: true,
			numberOfMonths: 2,
			onSelect: function( selectedDate ) {
				$( "#CallRangeTo" ).datepicker( "option", "minDate", selectedDate );
			}
		});
		$( "#CallRangeTo" ).datepicker({
			changeMonth: true,
			numberOfMonths: 2,
			onSelect: function( selectedDate ) {
				$( "#CallRangeFrom" ).datepicker( "option", "maxDate", selectedDate );
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